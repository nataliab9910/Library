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
        $book = $this->get($id);
        $this->bookRepository->delete($book);
    }

    public function get($id)
    {
        $book = $this->bookRepository->findOneBy(['id' => $id]);
        return $book;
    }

    public function update($id, $title, $pages, $isbn)
    {
        $book = $this->get($id);
        if ($title)
        {
            $book->setTitle($title);
        }
        if ($pages)
        {
            $book->setPages($pages);
        }
        if ($isbn)
        {
            $book->setIsbn($isbn);
        }
        return $this->bookRepository->create($book);
    }
}