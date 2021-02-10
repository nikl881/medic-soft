<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\changeOrderType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DoctorListController extends AbstractController
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/doctor/list/{page}", defaults={"page": "1"}, name="doctor_table_index")
     */
    public function showDoctorList($page): Response
    {

//        $repository = $this->getDoctrine()->getRepository(User::class);
//        $users = $repository->findAll();
//        $usersAsc = $repository->findBy([], ['lastName' => 'ASC']);
//        $usersDesc = $repository->findBy([], ['lastName' => 'DESC']);

        $users = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAllPaginated($page);


        return $this->render('doctor_table_index/doctor_list.html.twig', [
                    'users' => $users,
//                'users  bAsc' => $usersAsc,
//                'usersDesc' => $usersDesc,
            ]
        );
    }

    /**
     * @Route("/doctor/details/{user}", name="doctor_details")
     */
    public function showDoctorDetails(User $user)
    {
        return $this->render('doctor_table_index/modal/doctor_details_modal.html.twig', [
            'user' => $user,
        ]);
    }


}
