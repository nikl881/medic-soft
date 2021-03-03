<?php

namespace App\Controller;

use App\Form\IntakeReasonType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class IntakeController extends AbstractController
{
    /**
     * @Route("/patient/intake", name="patient_intake")
     */
    public function intake(Request $request): Response
    {
        $form = $this->createForm(IntakeReasonType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
           $form->getData();

           dd($form);
        }

        return $this->render('patient/intake/patient_intake.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
