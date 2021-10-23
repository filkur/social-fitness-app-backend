<?php

namespace App\Repository\EventMember;

use App\Entity\EventMember\EventMember;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EventMember|null find($id, $lockMode = null, $lockVersion = null)
 * @method EventMember|null findOneBy(array $criteria, array $orderBy = null)
 * @method EventMember[]    findAll()
 * @method EventMember[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventMemberRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EventMember::class);
    }

    // /**
    //  * @return EventMember[] Returns an array of EventMember objects
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
    public function findOneBySomeField($value): ?EventMember
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
