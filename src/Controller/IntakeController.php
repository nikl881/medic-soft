<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class IntakeController extends AbstractController
{
    /**
     * @Route("/patient/intake", name="patient_intake")
     */
    public function login(): Response
    {
        return $this->render('patient/intake/patient_intake.html.twig');
    }

}
