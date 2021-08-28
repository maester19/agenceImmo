<?php

namespace App\Repository;

use App\Entity\Properties;
use App\Entity\PropertySearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query;

/**
 * @method Properties|null find($id, $lockMode = null, $lockVersion = null)
 * @method Properties|null findOneBy(array $criteria, array $orderBy = null)
 * @method Properties[]    findAll()
 * @method Properties[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertiesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Properties::class);
    }

    /**
     * @return Query
     * @param PropertySearch $search
     */

    public function findAllVisibleQuery(PropertySearch $search):Query
    {
        $query = $this->findVisibleQuery();

        if($search->getMaxPrice())
        {
            $query = $query
                        ->andWhere('p.price >= :maxprice')
                        ->setParameter('maxprice', $search->getMaxPrice());
        }

        if($search->getMinSurface())
        {
            $query = $query
                        ->andWhere('p.surface >= :minsurface')
                        ->setParameter('minsurface', $search->getMinSurface());
        }

        if ($search->getOptions()->count() >0)
        {
            $k = 0;
            foreach($search->getOptions() as $options)
            {
                $k++;
                $query = $query
                            ->andWhere(":options$k MEMBER OF p.options")
                            ->setParameter(":options$k", $options);
            }
        }
        
        return $query->getQuery();
    }

    /**
     * return Properties[]
     */

    public function findLatest():Array
    {
        return $this->findVisibleQuery()
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();
    }

    private function findVisibleQuery():QueryBuilder
    {
        return $this->createQueryBuilder("p")
            ->where("p.solde = false");
    }

    // /**
    //  * @return Properties[] Returns an array of Properties objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Properties
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
