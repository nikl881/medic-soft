<?php

namespace App\Repository;

use App\Entity\Patient;
use App\Entity\PatientRecordNote;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @method PatientRecordNote|null find($id, $lockMode = null, $lockVersion = null)
 * @method PatientRecordNote|null findOneBy(array $criteria, array $orderBy = null)
 * @method PatientRecordNote[]    findAll()
 * @method PatientRecordNote[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PatientRecordNoteRepository extends ServiceEntityRepository
{
    /**
     * @var ManagerRegistry
     */
    private ManagerRegistry $registry;
    /**
     * @var PaginatorInterface
     */
    private PaginatorInterface $paginator;

    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, PatientRecordNote::class);
        $this->registry = $registry;
        $this->paginator = $paginator;
    }

    public function getPatientNotesQuery(PatientRecordNote $note, Patient $patient)
    {
        $qb = $this->createQueryBuilder('p');

        $qb->select('p.title', 'p.id', 'p.content', 'p.created_at')
            ->orderBy('p.created_at', 'DESC')
            ->where('p.patient = :patientId')
            ->setParameter('patientId', $patient->getId())
            ->setMaxResults(3);

        return $qb->getQuery()->getResult();
    }

    public function getPatientNoteCreatedQuery(Patient $patient)
    {
        $qb = $this->createQueryBuilder('p');

        $qb->select('p.created_at')
            ->orderBy('p.created_at', 'DESC')
            ->where('p.patient = :patientId')
            ->setParameter('patientId', $patient->getId());

        return $qb->getQuery()->getResult();
    }

    public function findAllPaginatedNotes($page, Patient $patient)
    {
        $qb = $this->createQueryBuilder('v');

        $qb->select('v')
            ->where('v.patient = :patientId')
            ->setParameter('patientId',  $patient->getId());

        $pagination = $this->paginator->paginate($qb, $page, 10);

        return $pagination;
    }

}
