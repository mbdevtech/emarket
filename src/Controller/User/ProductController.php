<?php

namespace App\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Account\Profile;
use App\Entity\Catalog\Product;
use App\Form\ProductType;
use App\Entity\Catalog\Category;
use App\Entity\Catalog\Attribute;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints\Length;

/**
 *  It is a product controller
 */
class ProductController extends AbstractController
{
    /**
     * @Route("/user/product", name="user_product")
     */
    public function index()
    {
        return $this->render('user/product/index.html.twig', [
            'products' => $this->getDoctrine()->getRepository(Product::class)->findAll(),
        ]);
    }
    /**
     * Create a new product
     * @Route("/user/{id}/product/new", name="user_product_new")
     */
    public function new(Request $request, $id)
    {
        $profile = $this->getDoctrine()->getRepository(Profile::class)->find($id);
        $product = new Product();
        // set the product properties
        $product->setProfile($profile);
        // create the form and a response to the submission
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // call the manager to persist
            $entityManager = $this->getDoctrine()->getManager();
            $product->setCreatedAt(new \DateTime());
            $product->setEditedAt(new \DateTime());
            $product->setNew(1);
            $entityManager->persist($product);
            //dd($request->request->get("type"));
            $attributes = [];
            if ($request->request->get("Type") != NULL)   $attributes[] = ["Type", $request->request->get("Type")];
            if ($request->request->get("Mesures") != NULL)  $attributes[] = ["Mesures", $request->request->get("Mesures")];
            if ($request->request->get("Poids") != NULL)  $attributes[] = ["Poids", $request->request->get("Poids")];
            if ($request->request->get("Couleur") != NULL)  $attributes[] = ["Couleur", $request->request->get("Couleur")];
            if ($request->request->get("Forme") != NULL)  $attributes[] = ["Forme", $request->request->get("Forme")];
            if ($request->request->get("Expires") != NULL)  $attributes[] = ["Expires", $request->request->get("Expires")];
            //dd($attributes);
            // store attributes
            for ($i = 0; $i < count($attributes); $i++) {
                $attr = new Attribute();
                $attr->setAttrName($attributes[$i][0]);
                $attr->setAttrValue($attributes[$i][1]);
                $attr->setProduct($product);
                $entityManager->persist($attr);
            }
            $entityManager->flush();
            // redirect to login
            return $this->redirectToRoute('user_product');
        }
        //$categories = 
        // $jsonCategories = $serializer->serialize($categories, 'json');     
        return $this->render('user/product/product.html.twig', [
            'form' => $form->createView(),
            'categories' => $this->getDoctrine()->getRepository(Category::class)
                ->findAll(),
        ]);
    }
    /**
     * Create a new attribute
     * 
     */
    public function newAttr(Request $req, Product $prod, $attrname)
    {
        $em = $this->getDoctrine()->getManager();
        $attr = new Attribute();
        $attr->setAttrName($attrname);
        $attr->setAttrValue($req->request->get($attrname));
        $attr->setProduct($prod);
        $em->persist($attr);
        return;
    }

    /**
     * @Route("/user/product/edit", name="user_product_edit")
     */
    public function edit()
    {
        return $this->render('user/product/product.html.twig', [
            'controller_name' => 'CartController',
        ]);
    }

    /** 
     * @Route("/user/product/ajax", name = "product_ajax") 
     */
    public function ajaxAction(Request $request): Response
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        $myArr = array("John", "Mary", "Peter", "Sally");
        $myJSON = json_encode($myArr);
        return new JsonResponse($myJSON);
        if ($request->isXmlHttpRequest() || $request->query->get('showJson') == 1) {

            $jsonData = array();
            $idx = 0;
            foreach ($categories as $category) {
                $temp = array(
                    'id' => $category->getId(),
                    'name' => $category->getName(),
                    'parentId' => $category->getParentId(),
                );
                $jsonData[$idx++] = $temp;
            }
            return new JsonResponse($myJSON);
        } else {
            //dd($myJSON);
            return $this->render(
                'user/product/ajax.html.twig',
                ['categories' => $categories],
            );
            //return $this->redirectToRoute('home');
        }
    }
}
