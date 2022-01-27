<?php

namespace App\Repository;

use App\Entity\EmprintLivre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EmprintLivre|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmprintLivre|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmprintLivre[]    findAll()
 * @method EmprintLivre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmprintLivreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmprintLivre::class);
    }

    // /**
    //  * @return EmprintLivre[] Returns an array of EmprintLivre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EmprintLivre
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
