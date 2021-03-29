<?php

namespace App\Controller;

use App\Entity\Patient;
use App\Entity\PatientRecordNote;
use App\Entity\Treatment;
use App\Form\AddPatientGeneralNoteType;
use App\Form\AddPatientType;
use App\Form\UpdateProfileImagePatientType;
use App\Repository\PatientRecordNoteRepository;
use App\Repository\PatientRepository;
use App\Utils\uploadImagesToS3;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
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
    public function showAllPatientList($page, Request $request, PatientRepository $patientRepository): Response
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

        $patients = $patientRepository->findAllPaginatedPatients($page);

        return $this->render('patient/patient_list_total.html.twig', [
            'patients' => $patients,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/patient/list-doctor/{page}",  defaults={"page": 1 }, name="patient_list_doctor")
     */
    public function showDoctorsPatientList($page, Request $request, PatientRepository $patientRepository): Response
    {
        $user = $this->getUser();

        $form = $this->createForm(AddPatientType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $patient = $form->getData();
            $currentDoctor = $this->getUser();
            $patient->setdateCreated(new \DateTime());
            $patient->setUser($currentDoctor);
            $this->addFlash('success', 'New patient added');

            $em->persist($patient);
            $em->flush();

            return $this->redirectToRoute('patient_list_doctor');
        }

        $allDoctorIdInPatientList = $patientRepository->getDoctorForPatientList($user, $page);

        return $this->render('patient/patient_list_doctor.html.twig', [
            'patients' => $allDoctorIdInPatientList,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/patient/details/notes-list/{patient}/{page}", defaults={"page": 1 }, name="patient_notes_list")
     */
    public function patientNotesList($page, Patient $patient, PatientRecordNoteRepository $patientRecordNoteRepository)
    {

        $patientRecordNote = $patientRecordNoteRepository->findAllPaginatedNotes($page, $patient);

        return $this->render('patient/patient_notes_list.html.twig', [
            'patientRecordNote' => $patientRecordNote,
            'patient' => $patient,
        ]);

    }

    /**
     * @Route("/patient/details/{patient}", name="patient_details")
     */
    public function patientDetails(Patient $patient, Request $request, EntityManagerInterface $entityManager, UploadImagesToS3 $toS3, PatientRecordNoteRepository $patientRecordNoteRepository)
    {
        $patientRecordNote = $this->getDoctrine()->getRepository(PatientRecordNote::class);
        $patientTreatment = $this->getDoctrine()->getRepository(Treatment::class);

        $note = new PatientRecordNote();
        $notesForm = $this->createForm(AddPatientGeneralNoteType::class, $note);
        $notesForm->handleRequest($request);

        if ($notesForm->isSubmitted() && $notesForm->isValid()) {
            $note = $notesForm->getData();
            $note->setpatient($patient);

            $this->addFlash('success', 'Note added');
            $note->setcreatedAt(new \DateTime());

            $entityManager->persist($note);
            $entityManager->flush();
        }

        $profileImageForm = $this->createForm(UpdateProfileImagePatientType::class, $patient);
        $profileImageForm->handleRequest($request);

        if ($profileImageForm->isSubmitted() && $profileImageForm->isValid()) {

            $this->getDoctrine()->getManager();
            $file = $profileImageForm->get('profileImage')->getData();

            $toS3->uploadProfileImageToS3Bucket($file);

            $image_path = "https://medicsoft-bucket.s3.eu-central-1.amazonaws.com/images/";
            $image_name = $file->getClientOriginalName();
            $combine = $image_path . '' . $image_name;
            $patient->setProfileImage($combine);

            $this->addFlash('success', 'Patient profile image updated');
            $this->entityManager->flush();
        }

        $getNoteQuery = $patientRecordNoteRepository->getPatientNotesQuery($note, $patient);

        return $this->render('patient/patient_details.html.twig', [
            'patient' => $patient,
            'patientRecordNote' => $patientRecordNote,
            'allPatientNotes' => $getNoteQuery,
            'patientTreatment' => $patientTreatment,
            'notesForm' => $notesForm->createView(),
            'patientProfileForm' => $profileImageForm->createView(),
        ]);

    }

    /**
     * @Route ("delete-patient-note/{note}", name="delete_patient_note")
     */
    public function deleteNote(PatientRecordNote $note)
    {
        $getPatient = $note->getPatient();

        $em = $this->getDoctrine()->getManager();
        $em->remove($note);
        $em->flush();

        return $this->redirectToRoute('patient_details', ['patient' => $getPatient->getId()]);
    }

    /**
     * @Route("/patient/details/edit/{patient}", name="edit_patient_settings")
     */
    public function editPatientSettings()
    {
        return $this->render('patient/edit_patient_settings.html.twig');
    }


}
