<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    /**
     * @Route("/admin/order", name="admin_order")
     */
    public function index()
    {
        return $this->render('admin/order/index.html.twig', [
            'controller_name' => 'OrderController',
        ]);
    }
}
