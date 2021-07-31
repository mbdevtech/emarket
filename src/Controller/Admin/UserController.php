<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/admin/user", name="admin_user")
     */
    public function index()
    {
        return $this->render('admin/user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
    /**
     * @Route("/admin", name="admin")
     */
    public function admin()
    {
        return $this->render('admin/admin.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
