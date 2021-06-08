<?php

namespace App\Controller;

use App\Entity\Rental;
use App\Repository\RentalRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/admin/pannel", name="admin_pannel")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
        ]);
    }

    /**
     * @Route("/admin/pannel/user", name="admin_users")
     */
    public function user(): Response
    {
        // TODO
        return $this->render('admin/users.html.twig', [
        ]);
    }

    /**
     * @Route("/admin/pannel/books", name="admin_books")
     */
    public function books(): Response
    {
        // TODO
        return $this->render('admin/books.html.twig', [
        ]);
    }

    /**
     * @Route("/admin/pannel/rentals", name="admin_rentals")
     */
    public function rentalsStatus(RentalRepository $rentalRepository): Response
    {
        $ordered = $rentalRepository->findBy(['status'=>Rental::STATUS_ORDERED]);
        $waiting = $rentalRepository->findBy(['status'=>Rental::STATUS_WAITING]);
        $rented = $rentalRepository->findBy(['status'=>Rental::STATUS_RENTED]);
        return $this->render('admin/rentals.html.twig', [
            'ordered' => $ordered,
            'waiting' => $waiting,
            'rented' => $rented,
        ]);
    }

    /**
     * @Route("/admin/pannel/users", name="admin_users")
     */
    public function users(Request $request, HttpClientInterface $client): Response
    {
        //TODO
        if (!$barcode = $request->query->get('barcode'))
        {
            return $this->render('admin/users.html.twig', [
                'controller_name' => 'AdminController',
            ]);
        }

        $url = 'https://localhost:8000/api/cards?page=1&barcode=' . $barcode;
        //dd($request);
        $response = $client->request(
            'GET',
            $url
        );

        dd($response);

        return $this->render('admin/users.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
}
