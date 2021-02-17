<?php

namespace App\Controller;

use App\Entity\Patient;
use App\Repository\PatientRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function showAllPatientList(PaginatorInterface $paginator, $page): Response
    {
        $patients = $this->getDoctrine()
            ->getRepository(Patient::class)
            ->findAllPaginatedPatients($page);

        return $this->render('patient/patient_list_total.html.twig', [
             'patients' => $patients,
        ]);
    }

    /**
     * @Route("/patient/list-doctor/{page}",  defaults={"page": 1 }, name="patient_list_doctor")
     */
    public function showDoctorsPatientList(PaginatorInterface $paginator, $page): Response
    {
        $user = $this->getUser();

        $allDoctorIdInPatientList = $this->getDoctrine()
            ->getRepository(Patient::class)
            ->getDoctorIdInPatientList($user , $page);


        return $this->render('patient/patient_list_doctor.html.twig', [
            'patients' => $allDoctorIdInPatientList,
        ]);
    }


}
