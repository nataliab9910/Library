<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    public function findAllWithSearch(?string $search)
    {
        $queryBuilder = $this->createQueryBuilder('b');

        if ($search)
        {
            $queryBuilder->where('b.title LIKE :search')
                ->setParameter('search', '%' . $search . '%');
        }

        return $queryBuilder
            ->orderBy('b.title')
            ->getQuery()
            ->getResult();
    }

    public function create(Book $book)
    {
        $this->getEntityManager()->persist($book);
        $this->getEntityManager()->flush();
        return $book;
    }

    public function delete(Book $book)
    {
        $this->getEntityManager()->remove($book);
        $this->getEntityManager()->flush();
    }
}
