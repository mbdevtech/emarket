<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SettingController extends AbstractController
{
    /**
     * @Route("/admin/setting", name="admin_setting")
     */
    public function index()
    {
        return $this->render('admin/setting/index.html.twig', [
            'controller_name' => 'SettingController',
        ]);
    }
}
