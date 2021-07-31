<?php

namespace App\Controller\Shopping;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="shopping_cart")
     */
    public function index()
    {
        return $this->render('shopping/cart/index.html.twig', [
            'controller_name' => 'CartController',
        ]);
    }

    /**
     * @Route("/checkout", name="shopping_checkout")
     */
    public function checkout()
    {
        return $this->render('shopping/cart/checkout.html.twig', [
            'controller_name' => 'CartController',
        ]);
    }
}
