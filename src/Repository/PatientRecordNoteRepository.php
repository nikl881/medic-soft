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

    public function testQuery(PatientRecordNote $note)
    {
        $qb = $this->createQueryBuilder('p');

        $qb->select('p.title')
            ->orderBy('p.created_at', 'DESC')
            ->setMaxResults(3);

        return $qb->getQuery()->getResult();
    }

}
