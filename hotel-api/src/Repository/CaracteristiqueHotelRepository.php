<?php

namespace App\Repository;

use App\Entity\CaracteristiqueHotel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CaracteristiqueHotel|null find($id, $lockMode = null, $lockVersion = null)
 * @method CaracteristiqueHotel|null findOneBy(array $criteria, array $orderBy = null)
 * @method CaracteristiqueHotel[]    findAll()
 * @method CaracteristiqueHotel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CaracteristiqueHotelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CaracteristiqueHotel::class);
    }

    // /**
    //  * @return CaracteristiqueHotel[] Returns an array of CaracteristiqueHotel objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CaracteristiqueHotel
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
