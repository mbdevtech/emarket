<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    /**
     * @Route("/admin/page", name="admin_page")
     */
    public function index()
    {
        return $this->render('admin/page/index.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }
}
