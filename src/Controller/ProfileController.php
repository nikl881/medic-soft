<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UpdateProfileImageType;
use App\Form\UpdateProfileType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/profile", name="profile")
     */
    public function showProfile(Request $request): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $form = $this->createForm(UpdateProfileType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->addFlash('success', 'Profile updated');
            $this->entityManager->flush();

            return $this->redirectToRoute('profile');
        }


        return $this->render('profile/profile.html.twig', [
            'controller_name' => 'ProfileController',
            'form' => $form->createView(),

        ]);
    }

}
