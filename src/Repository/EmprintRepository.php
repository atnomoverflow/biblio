<?php

namespace App\Repository;

use App\Entity\Emprint;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Emprint|null find($id, $lockMode = null, $lockVersion = null)
 * @method Emprint|null findOneBy(array $criteria, array $orderBy = null)
 * @method Emprint[]    findAll()
 * @method Emprint[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmprintRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Emprint::class);
    }

    // /**
    //  * @return Emprint[] Returns an array of Emprint objects
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
    public function findOneBySomeField($value): ?Emprint
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
