<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(): Response
    {
        return $this->render('homepage/index.html.twig', [
        ]);
    }

    /**
     * @Route("/search", name="search")
     */
    public function search(BookRepository $repository, Request $request): Response
    {
        // TODO: service
        $search = $request->query->get('search');
        $books = $repository->findAllWithSearch($search);

        return $this->render('homepage/searchresult.html.twig', [
            'books' => $books,
        ]);
    }

}
