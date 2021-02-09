<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DoctorListController extends AbstractController
{
    /**
     * @Route("/doctor/list", name="doctor_list")
     */
    public function showDoctorList(): Response
    {

        $repository = $this->getDoctrine()->getRepository(User::class);
        $users = $repository->findBy([], ['lastName' => 'ASC']);


        return $this->render('doctor_list/doctor_list.html.twig',
            ['users' => $users]
        );
    }
}
