<?php

namespace App\Controller\Blog;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SectionController extends AbstractController
{
    /**
     * @Route("/section", name="blog_section")
     */
    public function index()
    {
        return $this->render('blog/section/index.html.twig', [
            'controller_name' => 'SectionController',
        ]);
    }
}
