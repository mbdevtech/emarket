<?php

namespace App\Controller\Catalog;

use App\Entity\Catalog\Discount;
use App\Form\Catalog\DiscountType;
use App\Repository\Catalog\DiscountRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/catalog/discount")
 */
class DiscountController extends AbstractController
{
    /**
     * @Route("/", name="catalog_discount_index", methods={"GET"})
     */
    public function index(DiscountRepository $discountRepository): Response
    {
        return $this->render('catalog/discount/index.html.twig', [
            'discounts' => $discountRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="catalog_discount_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $discount = new Discount();
        $form = $this->createForm(DiscountType::class, $discount);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($discount);
            $entityManager->flush();

            return $this->redirectToRoute('catalog_discount_index');
        }

        return $this->render('catalog/discount/new.html.twig', [
            'discount' => $discount,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="catalog_discount_show", methods={"GET"})
     */
    public function show(Discount $discount): Response
    {
        return $this->render('catalog/discount/show.html.twig', [
            'discount' => $discount,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="catalog_discount_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Discount $discount): Response
    {
        $form = $this->createForm(DiscountType::class, $discount);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('catalog_discount_index');
        }

        return $this->render('catalog/discount/edit.html.twig', [
            'discount' => $discount,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="catalog_discount_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Discount $discount): Response
    {
        if ($this->isCsrfTokenValid('delete' . $discount->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($discount);
            $entityManager->flush();
        }

        return $this->redirectToRoute('catalog_discount_index');
    }
}
