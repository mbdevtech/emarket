<?php

namespace App\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SaleController extends AbstractController
{
    /**
     * @Route("/user/sale", name="user_sale")
     */
    public function index()
    {
        return $this->render('user/sale/index.html.twig', [
            'controller_name' => 'CartController',
        ]);
    }
}
