<?php

namespace App\DataFixtures;

use App\Entity\Book;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BookFixture extends Fixture
{
    const BOOK_DATA = [["Dziewczyna, która igrała z ogniem", 699, "1111111111111", "2009-01-12 00:00:00"],
        ["Lew, czarownica i stara szafa", 181, "9788372781758", "1948-04-10 00:00:00"],
        ["Księżniczka z lodu", 424, "9788375541052", "1995-12-01 00:00:00"]];

    public function load(ObjectManager $manager)
    {
        foreach (self::BOOK_DATA as $bookData) {
            $book = $this->makeBook(...$bookData);
            $manager->persist($book);
        }

        $manager->flush();
    }

    private function makeBook($title, $pages, $isbn, $publishedAt) {
        $book = new Book();
        $book->setTitle($title);
        $book->setPages($pages);
        $book->setIsbn($isbn);
        $book->setPublishedAt(new DateTime($publishedAt));
        return $book;
    }
}
