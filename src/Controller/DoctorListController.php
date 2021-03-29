<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DoctorListController extends AbstractController
{

    private EntityManagerInterface $entityManager;
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    public function __construct(EntityManagerInterface $entityManager, UserRepository $userRepository)
    {
        $this->entityManager = $entityManager;
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("/doctor/list/{page}", defaults={"page": 1 }, name="doctor_list")
     */
    public function showDoctorList($page, UserRepository $userRepository): Response
    {

        $users = $userRepository->findAllPaginatedDoctors($page);

        return $this->render('doctor/doctor_list.html.twig', [
                'users' => $users
            ]
        );
    }

    /**
     * @Route("/doctor/details/{user}", name="doctor_details")
     */
    public function showDoctorDetails()
    {
        return $this->render('doctor/modal/doctor_details_modal.html.twig');
    }


}
