<?php

namespace App\Controller;

use App\Entity\Patient;
use App\Form\AddPatientGeneralNoteType;
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

            return $this->redirectToRoute('patient_list_total');
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
    public function showDoctorsPatientList($page, Request $request): Response
    {
        $user = $this->getUser();

        $form = $this->createForm(AddPatientType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {



            $em = $this->getDoctrine()->getManager();
            $patient = $form->getData();
            $patient->setdateCreated(new \DateTime());

            $this->addFlash('success', 'New patient added');

            $em->persist($patient);
            $em->flush();

            return $this->redirectToRoute('patient_list_doctor');
        }

        $allDoctorIdInPatientList = $this->getDoctrine()
            ->getRepository(Patient::class)
            ->getDoctorForPatientList($user, $page);


        return $this->render('patient/patient_list_doctor.html.twig', [
            'patients' => $allDoctorIdInPatientList,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/patient/details/{patient}", name="patient_details")
     */
    public function patientDetails(Patient $patient, Request $request)
    {
        $notesForm = $this->createForm(AddPatientGeneralNoteType::class);
        $notesForm->handleRequest($request);

        return $this->render('patient/patient_details.html.twig', [
            'patient' => $patient,
            'notesForm' => $notesForm->createView(),
        ]);

    }




}
