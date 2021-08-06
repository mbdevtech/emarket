<?php

namespace App\Controller;

use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Catalog\Product;
use App\Entity\Catalog\Review;


class StoreController extends AbstractController
{
    /**
     * @Route("/products2", name="shopping_products2")
     */
    public function index2()
    {
        return $this->render('shopping/product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }

    /**
     * @Route("/product2", name="shopping_product2")
     */
    public function produc2t()
    {
        return $this->render('shopping/product/product.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }

    /**
     * @Route("/store", name="store")
     */
    public function index(Request $request, PaginatorInterface $paginator)
    {
        $products = $this->getDoctrine()->getRepository(Product::class)->findAllProductPhoto(0);
        // paginator
        $pagination = $paginator->paginate(
            $products, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            12/*limit per page*/
        );

        return $this->render('shopping/store/index.html.twig', [
            'pagination' => $pagination,
            'category' => 0,
            'discounts' => $this->getDoctrine()->getRepository(Product::class)->findAllDiscounts()

        ]);
    }
    /**
     * @Route("/store/{id}/products", name="category_products")
     */
    public function products(?int $id, Request $request, PaginatorInterface $paginator)
    {
        $products = $this->getDoctrine()->getRepository(Product::class)->findAllProductPhoto($id);
        // paginator
        $pagination = $paginator->paginate(
            $products, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            12/*limit per page*/
        );

        return $this->render('shopping/store/index.html.twig', [
            'pagination' => $pagination,
            'category' => ($id != null) ? $id : 0,
            'discounts' => $this->getDoctrine()->getRepository(Product::class)->findAllDiscounts()
        ]);
    }
    /**
     * @Route("/store/{id}/products/{index}", name="product_detail")
     */
    public function product(?int $id, Request $request, int $index): Response
    {
        $product_photo = $this->getDoctrine()->getRepository(Product::class)->findOneProductPhoto($index);
        // id=category_id  index=product_id
        $alternate_products = $this->getDoctrine()->getRepository(Product::class)->findOtherProductPhoto($id, $index);
        // we provide the product reviews in product detail
        $product_reviews = $this->getDoctrine()->getRepository(Review::class)->findReviews($index);
        // avg rate
        $avg_rate = $this->getDoctrine()->getRepository(Review::class)->findAverageRate($index);
        return $this->render('shopping/product/product.html.twig', [
            'category' => $id,
            'product' => $product_photo,
            'similar' => $alternate_products,
            'reviews' => $product_reviews,
            'avg_rate' => $avg_rate
        ]);
    }
}
