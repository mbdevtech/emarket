<?php

namespace App\Controller;

use App\Entity\Catalog\Product;
use App\Entity\Catalog\Category;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;
use App\Form\ContactFormType;

class HomeController extends AbstractController
{
    private MailerInterface $Mailer;
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request, PaginatorInterface $paginator)
    {
        $products = $this->getDoctrine()->getRepository(Product::class)->findAllProductPhoto(130, 150);
        $discounts = $this->getDoctrine()->getRepository(Product::class)->findAllDiscounts();

        $categories = $this->getDoctrine()->getRepository(Product::class)->findByCategory(1);
        $sections = $this->getDoctrine()->getRepository(Category::class)->findMainCategories();
        $allsections = $this->getDoctrine()->getRepository(Category::class)->findAll();

        // paginator
        $pagination = $paginator->paginate(
            $products, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            8/*limit per page*/
        );

        return $this->render('home/index.html.twig', [
            'discounts'  => $discounts,
            'pagination' => $pagination,
            'categories' => $categories,
            'sections' => $sections,
            'allsections' => $allsections,
            'category' => 0
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request, MailerInterface $mailer): Response
    {
        $this->Mailer = $mailer;
        // create the form
        $form = $this->createForm(ContactFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $html = '<h1>EMarket Team</h1>' .
                '<h2>Thanks! we got your message, we will contact you soon...</h2>' .
                '<hr>
                <h6>Your original message</h6><br>
                <p>' . $form->get('message')->getData() . '</p>';
            $email = (new Email())
                ->from('admin@myshop.com')
                ->to($form->get('email')->getData())
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                //->replyTo('fabien@example.com')
                //->priority(Email::PRIORITY_HIGH)
                ->subject('Symfony mailer integration test')
                //->text()
                ->html($html);
            $this->Mailer->send($email);
        }
        return $this->render('home/contact.html.twig', [
            'Contact' => $form->createView(),
        ]);
    }

    /**
     * @Route("/contact/email")
     */
    public function sendEmail(MailerInterface $mailer): Response
    {
        $this->Mailer = $mailer;
        $email = (new Email())
            ->from('mahfoudbousba2@gmail.com')
            ->to('mahfoud_bousba@yahoo.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text('Saha ftourek!')
            ->html('<h2>See Twig integration for better HTML integration!</h2>');
        //dd($email);
        $this->Mailer->send($email);
        return $this->render('home/contact.html.twig');
    }
    /**
     * @Route("/contact/t_email")
     */
    public function sendTemplatedEmail(MailerInterface $mailer): Response
    {

        $email = (new TemplatedEmail())
            ->from('mahfoud_bousba@yahoo.com')
            ->to(new Address('khaledbousba3@gmai.com'))
            ->subject('Thanks for signing up!')

            // path of the Twig template to render
            ->htmlTemplate('user/message.html.twig')

            // pass variables (name => value) to the template
            ->context([
                'expiration_date' => new \DateTime('+7 days'),
                'username' => 'foo',
            ]);


        return $this->render('home/contact.html.twig');
    }
    /**
     * @Route("/404", name="404")
     */
    public function notFound()
    {
        return $this->render('bundles\TwigBundle\Exception\error404.html.twig');
    }
}
