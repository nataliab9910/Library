<?php


namespace App\Controller;


use App\Service\BookService\BookServiceInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
    public function createBook(Request $request, BookServiceInterface $service): JsonResponse
    {
        $title = $request->query->get('title');
        $pages = $request->query->get('pages');
        $isbn = $request->query->get('isbn');
        $book = $service->create($title, $isbn, $pages);

        return $this->json(['status' => 'created', 'id' => $book->getId()], Response::HTTP_CREATED);
    }

    /**
     * @Route("/book/delete/{id}", name="admin_delete_book")
     */
    public function deleteBook($id, BookServiceInterface $service) : JsonResponse
    {
        $service->delete($id);

        return $this->json(['status' => 'deleted'], Response::HTTP_OK);
    }

    /**
     * @Route("/book/get/{id}", name="admin_get_book")
     */
    public function getBook($id, BookServiceInterface $service) : JsonResponse
    {
        $book = $service->get($id);

        return $this->json(['status' => 'retrieved', 'book'=>$book], Response::HTTP_OK);
    }

    /**
     * @Route("/book/update/{id}", name="admin_update_book")
     */
    public function updateBook($id, BookServiceInterface $service, Request $request) : JsonResponse
    {
        $title = $request->query->get('title');
        $pages = $request->query->get('pages');
        $isbn = $request->query->get('isbn');
        $book = $service->update($id, $title, $pages,$isbn);

        return $this->json(['status' => 'updated', 'book'=>$book], Response::HTTP_OK);
    }
}