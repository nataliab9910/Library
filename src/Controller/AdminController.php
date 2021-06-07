<?php

namespace App\Controller;

use App\Repository\CardRepository;
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
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/admin/pannel/users", name="admin_users")
     */
    public function users(Request $request, HttpClientInterface $client): Response
    {
        if (!$barcode = $request->query->get('barcode'))
        {
            return $this->render('admin/users.html.twig', [
                'controller_name' => 'AdminController',
            ]);
        }

        $url = 'https://localhost:8000/api/cards?page=1&barcode='.$barcode;
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

    /**
     * @Route("/admin/pannel/user", name="admin_user")
     */
    public function user(): Response
    {
        return $this->render('admin/users.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/admin/pannel/books", name="admin_books")
     */
    public function books(): Response
    {
        return $this->render('admin/books.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/admin/pannel/rentals", name="admin_rentals")
     */
    public function rentals(): Response
    {
        return $this->render('admin/rentals.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
}
