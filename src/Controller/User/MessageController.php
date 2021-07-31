<?php

namespace App\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class MessageController extends AbstractController
{
    /**
     * @Route("/user/message", name="user_message")
     */
    public function index()
    {
        return $this->render('user/message/index.html.twig', [
            'controller_name' => 'CartController',
        ]);
    }
    /**
     * @Route("user/email")
     */
    public function sendEmail(MailerInterface $mailer)
    {
        $email = (new Email())
            ->from('admin@example.com')
            ->to('abdou1@gmail.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');
            //->body();

        $mailer->send($email);
        dd($email);
        return $this->render('user/message/email.html.twig', [
            'message' => $email,
        ]);
    }
}
