<?php

namespace App\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Catalog\Review;
use App\Entity\Catalog\Product;
use App\Entity\Account\Profile;

class ReviewController extends AbstractController
{
    /**
     * @Route("/user/review", name="user_review")
     */
    public function index(): Response
    {
        return $this->render('user_review/index.html.twig', [
            'Reviewss' => $this->getDoctrine()->getRepository(Review::class)->findAll(),
        ]);
    }
    /**
     * Add a new review
     * @Route("/user/{user_id}/{prod_id}/review/new", name="user_review_new")
     */
    public function new(Request $request, $user_id, $prod_id): Response
    {
        // profile who made the review
        $profile = $this->getDoctrine()->getRepository(Profile::class)->find($user_id);
        // review's product
        $product = $this->getDoctrine()->getRepository(Product::class)->find($prod_id);
        // new review
        $review = new Review();
        // set the review properties
        $review->setProfile($profile);
        $review->setProduct($product);
        $rate = $request->request->get("rate");
        $review->setRate(floatval($rate));
        $review->setEditedAt(new \DateTime());
        $review->setContent($request->request->get("content"));
        // save the review to the db
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($review);
        $entityManager->flush();
        // go back to product detail

        return $this->redirectToRoute('product_detail', ['id' => $user_id, 'index' => $prod_id]);
    }
}
