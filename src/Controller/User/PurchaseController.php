<?php

namespace App\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PurchaseController extends AbstractController
{
    /**
     * @Route("/user/purchase", name="user_purchase")
     */
    public function index()
    {
        return $this->render('user/purchase/index.html.twig', [
            'controller_name' => 'CartController',
        ]);
    }
}
