<?php
/**
 * Created by PhpStorm.
 * User: axxahretz
 * Date: 30.10.18
 * Time: 22:41
 */

namespace App\Repository;

    use App\Entity\Prestataire;
    use App\Entity\Service;
    use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
    use Symfony\Bridge\Doctrine\RegistryInterface;

    /**
     * @method Service|null find($id, $lockMode = null, $lockVersion = null)
     * @method Service|null findOneBy(array $criteria, array $orderBy = null)
     * @method Service[]    findAll()
     * @method Service[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
     */
class ServiceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Service::class);
    }

    //invoked by ServiceController

    public function findBySlug($slug){

        $qb = $this->createQueryBuilder('s')
            ->where('s.slug = :slug')
            ->setParameter('slug', $slug);

        return $qb
            ->getQuery()
            ->getResult();
    }
//    /**
//     * @return Service[] Returns an array of Service objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Service
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /* get a service according to its provided slug identifier */

        /**
         * @param $slug
         * @return Service|null
         */

        public function serviceIdentifier($slug): ?Service{


            return $this->createQueryBuilder('s')
                ->where('s.slug = :slug')
                ->setParameter('slug', $slug)
                ->andWhere('s.valide = true')
                ->getQuery()
                ->getResult();
        }


        // query services by perstataire

        /**
         * @param $arg
         * @return Prestataire|null
         */
        public function servicesByPrestaitre($arg): ?Prestataire{
            $em = $this->getEntityManager();
            $query = $em->createQuery('SELECT service.name as nameService, service.id FROM service INNER JOIN prestataire_service ON prestataire_service.prestataire_id = service.id WHERE prestataire_id = :prestataire')
                ->setParameter('prestataire',$arg);

            return $services = $query->execute();

        }

    }