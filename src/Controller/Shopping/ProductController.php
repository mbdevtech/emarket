<?php

namespace App\Controller\Shopping;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/products", name="shopping_products")
     */
    public function index()
    {
        return $this->render('shopping/product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }

    /**
     * @Route("/product", name="shopping_product")
     */
    public function product()
    {
        return $this->render('shopping/product/product.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }
}
