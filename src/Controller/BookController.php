<?php


namespace App\Controller;


use App\Service\BookService\BookServiceInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class BookController extends AbstractController
{
    /**
     * @Route("/book/add", name="admin_create_book")
     */
    public function createBook(Request $request, BookServiceInterface $service): Response
    {
        $title = $request->query->get('title');
        $pages = $request->query->get('pages');
        $isbn = $request->query->get('isbn');
        $book = $service->create($title, $isbn, $pages);

        return $this->json(['status' => 'created', 'id' => $book->getId()], Response::HTTP_CREATED);
    }
}