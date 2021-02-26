<?php

namespace App\Controller;

use App\Entity\Patient;
use App\Entity\PatientRecordNote;
use App\Form\AddPatientGeneralNoteType;
use App\Form\AddPatientType;
use App\Repository\PatientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PatientListController extends AbstractController
{

    private PatientRepository $patientRepository;
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    public function __construct(PatientRepository $patientRepository, EntityManagerInterface $entityManager)
    {
        $this->patientRepository = $patientRepository;
        $this->entityManager = $entityManager;
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
    public function patientDetails(Patient $patient, Request $request, EntityManagerInterface $entityManager)
    {
        $note = new PatientRecordNote();
        $notesForm = $this->createForm(AddPatientGeneralNoteType::class, $note);
        $notesForm->handleRequest($request);

        if ($notesForm->isSubmitted() && $notesForm->isValid())
        {
            $note = $notesForm->getData();
            $note->setpatient($patient);

            $this->addFlash('success', 'Note added!');
            $note->setcreatedAt(new \DateTime());

             $entityManager->persist($note);
             $entityManager->flush();
        }

        return $this->render('patient/patient_details.html.twig', [
            'patient' => $patient,
            'notesForm' => $notesForm->createView(),
        ]);

    }

}
