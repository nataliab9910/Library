<?php

namespace App\Repository;

use App\Entity\AffiliatesBooks;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AffiliatesBooks|null find($id, $lockMode = null, $lockVersion = null)
 * @method AffiliatesBooks|null findOneBy(array $criteria, array $orderBy = null)
 * @method AffiliatesBooks[]    findAll()
 * @method AffiliatesBooks[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AffiliatesBooksRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AffiliatesBooks::class);
    }

}
