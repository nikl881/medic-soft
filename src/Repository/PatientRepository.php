<?php

namespace App\Repository;

use App\Entity\Patient;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method Patient|null find($id, $lockMode = null, $lockVersion = null)
 * @method Patient|null findOneBy(array $criteria, array $orderBy = null)
 * @method Patient[]    findAll()
 * @method Patient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PatientRepository extends ServiceEntityRepository
{

    /**
     * @var PaginatorInterface
     */
    private PaginatorInterface $paginator;

    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Patient::class);
        $this->paginator = $paginator;
    }


    public function findAllPaginatedPatients($page)
    {
        $dbquery = $this->createQueryBuilder('v')
            ->getQuery();

        $pagination = $this->paginator->paginate($dbquery, $page, 10);

        return $pagination;
    }

    public function findAllPaginatedPatientsForDoctor($page)
    {
        $dbquery = $this->createQueryBuilder('v')
            ->getQuery();

        $pagination = $this->paginator->paginate($dbquery, $page, 10);

        return $pagination;
    }

    public function loadUserId($id)
    {
        return $this->createQueryBuilder('u')
            ->where('u.id = id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getDoctorIdInPatientList(User $user)
    {
        $qb = $this->createQueryBuilder('p');

        $qb->select('p.primaryDoctorId')
            ->where('p.primaryDoctorId = :userId')
            ->setParameter('userId',  $user->getId());


        return $qb->getQuery()->getResult();
    }


    public function testQuery(User $user)
    {
        $qb = $this->createQueryBuilder('p');

        $qb->select('p.lastName')
            ->where('p.lastName = :lastName')
            ->setParameter('lastName', $user->getLastName());

        return $qb->getQuery()->getResult();
    }


//    public function getDoctorIdInPatientList(User $user)
//    {
//        $qb = $this->createQueryBuilder('p');
//        $qb->select('p.primaryDoctor');
//
//        $qb->select('identity(p.primaryDoctor)');  // parent fk id for entity
//
//
//        return $qb->getQuery()->getResult();
//
//    }
}
