<?php

namespace App\Controller;

use App\Entity\Patient;
use App\Form\AddPatientType;
use App\Repository\PatientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PatientListController extends AbstractController
{

    private PatientRepository $patientRepository;

    public function __construct(PatientRepository $patientRepository)
    {
        $this->patientRepository = $patientRepository;
    }

    /**
     * @Route("/patient/list-total/{page}",  defaults={"page": 1 }, name="patient_list_total")
     */
    public function showAllPatientList($page, Request $request): Response
    {

        $form = $this->createForm(AddPatientType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $patient = $form->getData();


            $patient->setdateCreated(new \DateTime());

            $this->addFlash('success', 'New patient added');



            $em->persist($patient);
            $em->flush();
        }

        $patients = $this->getDoctrine()
            ->getRepository(Patient::class)
            ->findAllPaginatedPatients($page);

        return $this->render('patient/patient_list_total.html.twig', [
            'patients' => $patients,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/patient/list-doctor/{page}",  defaults={"page": 1 }, name="patient_list_doctor")
     */
    public function showDoctorsPatientList($page): Response
    {
        $user = $this->getUser();

        $allDoctorIdInPatientList = $this->getDoctrine()
            ->getRepository(Patient::class)
            ->getDoctorForPatientList($user, $page);


        return $this->render('patient/patient_list_doctor.html.twig', [
            'patients' => $allDoctorIdInPatientList,
        ]);
    }


}
