<?php

namespace App\Controller;

use App\Entity\Patient;
use App\Form\IntakeReasonType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class IntakeController extends AbstractController
{
    /**
     * @Route("/patient/intake/{patient}", name="patient_intake")
     */
    public function intake(Request $request, Patient $patient): Response
    {
        $form = $this->createForm(IntakeReasonType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
           $em = $this->getDoctrine()->getManager();
           $form->getData();
           $em->persist($patient);
           $em->flush();

            return $this->redirectToRoute('patient_intake');
        }

        return $this->render('patient/intake/patient_intake.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
