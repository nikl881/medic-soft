<?php

namespace App\Controller;

use App\Entity\Patient;
use App\Form\IntakeDeterminationType;
use App\Form\IntakeReasonType;
use App\Form\IntakeUrgencyType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class IntakeController extends AbstractController
{
    /**
     * @Route("/patient/intake-part-one/{patient}", name="patient_intake_part_one")
     */
    public function intakePartOne(Request $request, Patient $patient): Response
    {
        $form = $this->createForm(IntakeReasonType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
           $em = $this->getDoctrine()->getManager();
           $treatment = $form->getData();
           $treatment->setpatient($patient);
           $em->persist($treatment);
           $em->flush();

            return $this->redirectToRoute('patient_intake_part_two', ['patient' => $patient->getId()]);
        }

        return $this->render('patient/intake/patient_intake_part_1.html.twig', [
            'form' => $form->createView(),
            'patient' => $patient,
        ]);
    }

    /**
     * @Route("/patient/intake-part-two/{patient}", name="patient_intake_part_two")
     */
    public function intakePartTwo(Patient $patient, Request $request)
    {
        $form = $this->createForm(IntakeUrgencyType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $treatment = $form->getData();
            $treatment->setpatient($patient);
            $em->persist($treatment);
            $em->flush();

            return $this->redirectToRoute('patient_intake_part_three', ['patient' => $patient->getId()]);
        }

        return $this->render('patient/intake/patient_intake_part_2.html.twig', [
            'form' => $form->createView(),
            'patient' => $patient,
        ]);
    }

    /**
     * @Route("/patient/intake-part-three/{patient}", name="patient_intake_part_three")
     */
    public function intakePartThree(Request $request, Patient $patient)
    {
        $form = $this->createForm(IntakeDeterminationType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $treatment = $form->getData();
            $treatment->setpatient($patient);
            $em->persist($treatment);
            $em->flush();

            return $this->redirectToRoute('patient_intake_part_three', ['patient' => $patient->getId()]);

//            return $this->redirectToRoute('diagnosis', ['patient' => $patient->getId()]);
        }

        return $this->render('patient/intake/patient_intake_part_3.html.twig', [
            'form' => $form->createView(),
            'patient' => $patient,
        ]);
    }


}
