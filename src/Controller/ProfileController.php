<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_USER")
 */

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     */
    public function index(): Response
    {
        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
        ]);
    }

    /**
     * @Route("/profile/userdata", name="userdata")
     */
    public function userdata(): Response
    {
        return $this->render('profile/userdata.html.twig', [
            'controller_name' => 'ProfileController',
        ]);
    }

    /**
     * @Route("/profile/rentals", name="rentals")
     */
    public function rentals(): Response
    {
        return $this->render('profile/rentals.html.twig', [
            'controller_name' => 'ProfileController',
        ]);
    }

    /**
     * @Route("/profile/orders", name="orders")
     */
    public function orders(): Response
    {
        return $this->render('profile/orders.html.twig', [
            'controller_name' => 'ProfileController',
        ]);
    }

    /**
     * @Route("/profile/history", name="history")
     */
    public function history(): Response
    {
        return $this->render('profile/history.html.twig', [
            'controller_name' => 'ProfileController',
        ]);
    }
}
