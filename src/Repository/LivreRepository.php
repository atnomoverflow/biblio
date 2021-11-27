<?php

namespace App\Repository;

use App\Entity\Filter;
use App\Entity\Livre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @method Livre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Livre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Livre[]    findAll()
 * @method Livre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LivreRepository extends ServiceEntityRepository
{
    /**
     * @var PaginationInterface
     */
    private $paginator;
    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Livre::class);
        $this->paginator = $paginator;
    }

    // /**
    //  * @return Livre[] Returns an array of Livre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Livre
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    /**
     * Repository method for finding the newest inserted
     * entry inside the database. Will return the latest
     * entry when one is existent, otherwise will return
     * null.
     *
     * @return Livre[]|null
     */
    public function findLastInserted()
    {
        return $this
            ->createQueryBuilder("L")
            ->orderBy("L.id", "DESC")
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();
    }
    /**
     * Récupère les produits en lien avec une recherche
     * @return PaginationInterface
     */
    public function findSearch(Filter $search, $ignorePrix = false): PaginationInterface
    {

        $query = $this->getSearchQuery($search)->getQuery();
        return $this->paginator->paginate(
            $query,
            $search->page,
            6
        );
    }

    /**
     * Récupère le prix minimum et maximum correspondant à une recherche
     * @return integer[]
     */
    public function findMinMax(): array
    {
        $results = $this
            ->createQueryBuilder('b')
            ->select('MIN(b.prix) as min', 'MAX(b.prix) as max')
            ->getQuery()
            ->getScalarResult();
        return [(int)$results[0]['min'], (int)$results[0]['max']];
    }

    private function getSearchQuery(Filter $search, $ignorePrix = false)
    {
        $query = $this
            ->createQueryBuilder('b')
            ->select('c', 'a' , 'b')
            ->join('b.categorie', 'c')
            ->leftjoin('b.auteurs', 'a');

        if (!empty($search->q) && $search->q!="") {
            $query = $query
                ->andWhere('b.titre LIKE :q or b.isbn = :isbn or a.nom Like :q or a.prenom Like :q')
                ->setParameter(':q', "%{$search->q}%")
                ->setParameter(":isbn",$search->q);
        }

        if (!empty($search->min) && $ignorePrix === false) {
            $query = $query
                ->andWhere('b.prix >= :min')
                ->setParameter(':min', $search->min);
        }

        if (!empty($search->max) && $ignorePrix === false) {
            $query = $query
                ->andWhere('b.prix <= :max')
                ->setParameter(':max', $search->max);
        }

        if (!empty($search->categories) && !$search->categories->isEmpty()) {
            $query = $query
                ->andWhere('c.id IN (:categories)')
                ->setParameter(':categories', $search->categories);
        }

        return $query;
    }
}
