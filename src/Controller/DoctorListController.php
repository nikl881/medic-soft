<?php

namespace App\Controller;

use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DoctorListController extends AbstractController
{
    /**
     * @Route("/doctor/list", name="doctor_table_index")
     */
    public function showDoctorList(): Response
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $users = $repository->findBy([], ['lastName' => 'ASC']);

        return $this->render('doctor_table_index/doctor_list.html.twig',
            ['users' => $users]
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
