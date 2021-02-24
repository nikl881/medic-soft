<?php

namespace App\Repository;

use App\Entity\PatientRecordNote;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PatientRecordNote|null find($id, $lockMode = null, $lockVersion = null)
 * @method PatientRecordNote|null findOneBy(array $criteria, array $orderBy = null)
 * @method PatientRecordNote[]    findAll()
 * @method PatientRecordNote[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PatientRecordNoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PatientRecordNote::class);
    }

    // /**
    //  * @return PatientRecordNote[] Returns an array of PatientRecordNote objects
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
    public function findOneBySomeField($value): ?PatientRecordNote
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
