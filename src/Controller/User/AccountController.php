<?php

namespace App\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Form\RegisterType;

use App\Entity\Account\User;
use App\Entity\Account\Profile;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Profiler\Profile as ProfilerProfile;

class AccountController extends AbstractController
{
    /**
     * @Route("/user/account", name="user_account")
     */
    public function index()
    {
        $user = $this->getUser();
        //dd($user);
        if ($user) {
            $profile = $user->getProfile();
            //dd($profile);

        } else $profile = -1;
        return $this->render('user/account/account.html.twig', [
            'profile' => $profile,
        ]);
    }

    /**
     * @Route("/login", name="user_login")
     */

    public function login(AuthenticationUtils $authenticationUtils)
    {

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
            'user/account/login.html.twig',
            [
                'last_username' => $lastUsername,
                'error' => $error
            ]
        );
    }
    /**
     * @Route("/account", name="user_register",  methods={"POST","GET"})
     */
    public function register(Request $request, userPasswordEncoderInterface $encoder)
    {
        $user = new User();
        $profile = new Profile();
        $user->updateRoles('ROLE_USER');
        //$user->addRole(['ROLE_USER','eeeeeee']);
        // create the form and a response to the submission
        $form = $this->createForm(RegisterType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // call the manager to persist
            $entityManager = $this->getDoctrine()->getManager();
            //            $user->setProfile($profile);

            $hash = $encoder->encodePassword($user, $user->confirm);
            $user->setPassword($hash);
            // persist the related tables
            $entityManager->persist($user);
            $entityManager->flush();
            // getid
            $id = $user->getId();
            //dd($id);

            // generate a redirection
            return $this->redirectToRoute('user_profile_new', [
                'id' => $id,
            ]);
        }
        return $this->render('user/account/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/user/logout", name="user_logout")
     */
    public function logout(Type $request = null)
    {
        # code...
    }
}
