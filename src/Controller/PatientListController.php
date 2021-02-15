<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PatientListController extends AbstractController
{
    /**
     * @Route("/patient/list", name="patient_list")
     */
    public function showPatientList(): Response
    {
        return $this->render('patient/patient_list.html.twig', [
            'controller_name' => 'PatientListController',
        ]);
    }
}
