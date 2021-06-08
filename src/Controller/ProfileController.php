<?php

namespace App\Controller;

use App\Entity\Rental;
use App\Entity\User;
use App\Service\RentalService\RentalServiceInterface;
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
     * @Route("/order/crete/{id}", name="order_book")
     */
    public function orderBook($id, RentalServiceInterface $service): Response
    {
        if (in_array($this->getUser()->getStatus(), [User::STATUS_BLOCKED, User::STTAUS_DISABLED])){
            return $this->redirectToRoute('userdata');
        }
        $service->create($this->getUser(), $id);
        return $this->redirectToRoute('orders');
    }

    /**
     * @Route("/rental/delete/{id}", name="delete_rental")
     */
    public function deleteRental($id, RentalServiceInterface $service): Response
    {
        $service->delete($id);
        return $this->redirectToRoute('orders');
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
