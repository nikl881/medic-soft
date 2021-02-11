<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\OrderChoiceType;
use App\Form\UpdateProfileType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\Translation\t;


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
     * @Route("/doctor/list/{page}", defaults={"page": "1"}, name="doctor_table_index")
     */
    public function showDoctorList($page, PaginatorInterface $paginator, Request $request, UserRepository $userRepository): Response
    {

        $orderChoiceform = $this->createForm(OrderChoiceType::class);
        $orderChoiceform->handleRequest($request);

        return $this->render('doctor_table_index/doctor_list.html.twig', [

                'users' => $this->userRepository->sortByLastNameQuery(
                    $orderChoiceform->get('lastName')->getData(),
                ),
                'form' => $orderChoiceform->createView(),
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
