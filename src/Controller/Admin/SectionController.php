<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SectionController extends AbstractController
{
    /**
     * @Route("/admin/section", name="admin_section")
     */
    public function index()
    {
        return $this->render('admin/section/index.html.twig', [
            'controller_name' => 'SectionController',
        ]);
    }
}
