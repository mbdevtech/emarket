<?php

namespace App\Repository\Messaging;

use App\Entity\Messaging\SentMessage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method SentMessage|null find($id, $lockMode = null, $lockVersion = null)
 * @method SentMessage|null findOneBy(array $criteria, array $orderBy = null)
 * @method SentMessage[]    findAll()
 * @method SentMessage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SentMessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SentMessage::class);
    }

    // /**
    //  * @return SentMessage[] Returns an array of SentMessage objects
    //  */
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
    public function findOneBySomeField($value): ?SentMessage
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
