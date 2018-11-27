<?php

namespace App\Repository;

use App\Entity\Prestataire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Prestataire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Prestataire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Prestataire[]    findAll()
 * @method Prestataire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrestataireRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Prestataire::class);
    }

    /**
     * @param $prestataireId
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */

    public function findOneByIdJoinedToServices($prestataireId)
    {
        return $this->createQueryBuilder('p')
            // p.services refers to the services" property on prestataire
            ->innerJoin('p.services_id', 'c')
            // selects all the services data to avoid the query
            ->addSelect('c')
            ->andWhere('p.id = :id')
            ->setParameter('id', $prestataireId)
            ->getQuery()
            ->getOneOrNullResult();
    }


    /*
    public function findOneBySomeField($value): ?Prestataire
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
