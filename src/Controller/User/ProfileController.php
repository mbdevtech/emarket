<?php

namespace App\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\String\Slugger\SluggerInterface;
use App\Form\ProfileType;
use App\Entity\Account\Profile;
use App\Entity\Account\User;
use App\Service\FileUploader;

class ProfileController extends AbstractController
{
    /**
     * @Route("/user/profile", name="user_profile")
     */
    public function index()
    {
        $user = $this->getUser();
        if (null == $user)
         {
           // deny access to this route ===> page 404  
           return $this->redirectToRoute("404")  ;
         }
        return $this->render('user/profile/index.html.twig', [
            'controller_name' => 'CartController',
        ]);
    }
     /**
     * @Route("/user/profile/{id}/new", name="user_profile_new", methods={"POST","GET"})
     */
    public function new(Request $request, $id,FileUploader $uploader)
    {

           $user = $this->getDoctrine()->getRepository(User::class)->find($id);
           $profile = new Profile();
          // set the profile properties
           $profile->setUserid($user) ; 
          // create the form and a response to the submission
          $form = $this->createForm(ProfileType::class, $profile);
          $form->handleRequest($request);
          
          if ($form->isSubmitted() && $form->isValid()) 
          {
            $profile->setDescription('My description');
            $profile->setCreatedAt(new \DateTime());
            $profile->setEditedAt(new \DateTime());
                               //
            $PictureFile = $form->get('picture')->getData();
            $CoverFile = $form->get('cover')->getData();

            if ($PictureFile)
            {
                //$uploader = new FileUploader(true);
                $newPicture = $uploader->upload($PictureFile, true);
                $profile->setPicture($newPicture);
            }
            //
            if ($CoverFile)
            {
                //$uploader = new FileUploader(false);
                $newCover = $uploader->upload($CoverFile, false);
                $profile->setCover($newCover);
            }
            // call the manager to persist
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($profile);
            $entityManager->flush();
            // redirect to login
            return $this->redirectToRoute('user_login',["profile"=>$profile]);
          }
              
         return $this->render('user/profile/profile.html.twig', [
            'form' => $form->createView(), 
          ]);
    }

    /**
     * @Route("/user/profile/edit", name="user_profile_edit", methods={"POST","GET"})
     */
    public function edit(Request $request, FileUploader $uploader)
    {
        /* this access control will be used later
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        // or add an optional message - seen by developers
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');
        */
         $user = $this->getUser();
          if (null == $user)
           {
             // deny access to this route ===> page 404  
             return $this->redirectToRoute("404")  ;
           }
          $profile = $this->getDoctrine()
                   ->getRepository(Profile::class)     
                   ->find($user->getProfile());
          // create the form and a response to the submission
          $form = $this->createForm(ProfileType::class, $profile);
          $form->handleRequest($request);

          if ($form->isSubmitted() && $form->isValid()) 
          {
                //         
                $profile->setDescription('My description');
                $profile->setEditedAt(new \DateTime());

                $PictureFile = $form->get('picture')->getData();
                $CoverFile = $form->get('cover')->getData();
               //

               if ($PictureFile)
               {
                    //$uploader = new FileUploader(true);
                    $newPicture = $uploader->upload($PictureFile, true);
                    $profile->setPicture($newPicture);
                }
                //
                if ($CoverFile)
                {
                    //$uploader = new FileUploader(false);
                    $newCover = $uploader->upload($CoverFile, false);
                    $profile->setCover($newCover);
                }
            // call the manager to persist
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($profile);
            $entityManager->flush();
          }
              
         return $this->render('user/profile/profile.html.twig', [
            'form' => $form->createView(), 
            'profile' => $profile,
          ]);
    }
}
