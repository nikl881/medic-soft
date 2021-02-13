<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\OrderByLastNameType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/doctor/list/{page}", defaults={"page": 1 }, name="doctor_table_index")
     */
    public function showDoctorList($page, Request $request, PaginatorInterface $paginator, EntityManagerInterface $entityManager): Response
    {
//        $orderByForm = $this->createForm(OrderByLastNameType::class);
//        $orderByForm->handleRequest($request);
//
//        $dql   = "SELECT s FROM App\Entity\User s";
//        $query = $entityManager->createQuery($dql);
//
//        $pagination = $paginator->paginate(
//            $query,
//            $request->query->getInt('page', 1),3);

        $users = $this->getDoctrine()
            ->getRepository(User::class)
            ->findAllPaginated($page);


        return $this->render('doctor_table_index/doctor_list.html.twig', [
                  'users' => $users
//                'pagination' => $pagination,
//                'users' => $this->userRepository->sortByLastNameQuery(
//                    $orderByForm->get('lastName')->getData(),
//                ),
//                'form' => $orderByForm->createView(),
            ]
        );
    }

    /**
     * @Route("/doctor/details/{user}", name="doctor_details")
     */
    public function showDoctorDetails(User $user)
    {
        return $this->render('doctor_table_index/modal/doctor_details_modal.html.twig', [
            'users' => $users,
        ]);
    }

}
