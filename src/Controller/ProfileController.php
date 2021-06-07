<?php

namespace App\Controller;

use App\Entity\Rental;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_USER")
 */
class ProfileController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
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
        return $this->renderBookpage('rentals', [Rental::STATUS_RENTED]);
    }

    /**
     * @Route("/profile/orders", name="orders")
     */
    public function orders(): Response
    {
        return $this->renderBookpage('orders', [Rental::STATUS_ORDERED,Rental::STATUS_WAITING]);
    }

    /**
     * @Route("/profile/history", name="history")
     */
    public function history(): Response
    {
        return $this->renderBookpage('history', [Rental::STATUS_RETURNED]);
    }

    /**
     * @Route("/order/{id}", name="order_book")
     */
    public function orderBook($id): Response
    {

        return $this->orders();
    }

    private function renderBookpage($name, $statuses)
    {
        $repository = $this->entityManager->getRepository(Rental::class);
        $rentals = [];
        foreach($statuses as $status) {
            array_push($rentals, ...$repository->findBy(['status' => $status, 'reader' => $this->getUser()]));
        }

        return $this->render('profile/' . $name . '.html.twig', [
            'rentals' => $rentals,
        ]);
    }
}
