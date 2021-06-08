<?php


namespace App\Service\BookService;


use App\Entity\Book;
use App\Repository\BookRepository;

class BookService implements BookServiceInterface
{
    private BookRepository $bookRepository;

    public function __construct(
        BookRepository $bookRepository
    )
    {
        $this->bookRepository = $bookRepository;
    }

    public function create($title, $isbn, $pages)
    {
        $book = new Book();
        $book->setTitle($title);
        $book->setIsbn($isbn);
        $book->setPages($pages);

        return $this->bookRepository->create($book);
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}