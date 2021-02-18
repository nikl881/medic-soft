<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\User;
use App\Form\UpdateProfileAddressType;
use App\Form\UpdateProfileImageType;
use App\Form\UpdateProfileType;
use App\Utils\uploadImagesToS3;
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
    public function editProfile(Request $request, UploadImagesToS3 $toS3): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $profileForm = $this->createForm(UpdateProfileType::class, $user);
        $profileForm->handleRequest($request);
  
        if ($profileForm->isSubmitted() && $profileForm->isValid()) {

            $this->addFlash('success', 'Profile updated');
            $this->entityManager->flush();

            return $this->redirectToRoute('profile');
        }


        $address = $user->getaddress();
        $addressForm = $this->createForm(UpdateProfileAddressType::class, $address);
        $addressForm->handleRequest($request);

        if ($addressForm->isSubmitted() && $addressForm->isValid()) {
            if (!$user->getAddress() instanceof Address) {

                /** @var Address $address */
                $address = $addressForm->getData();

                $user->setAddress($address);
                $this->entityManager->persist($address);
            }
            $this->addFlash('success', 'Address updated!');
            $this->entityManager->flush();

            if ($request->request->get('redirectUrl')) {
                return $this->redirect((string)$request->request->get('redirectUrl'));
            }

            return $this->redirectToRoute('profile');
        }


        $profileImageForm = $this->createForm(UpdateProfileImageType::class, $user);
        $profileImageForm->handleRequest($request);

        if ($profileImageForm->isSubmitted() && $profileImageForm->isValid()) {

            $this->getDoctrine()->getManager();
            $file = $profileImageForm->get('profileImage')->getData();

            $toS3->uploadProfileImageToS3Bucket($file);

            $image_path = "https://medicsoft-bucket.s3.eu-central-1.amazonaws.com/images/";
            $image_name = $file->getClientOriginalName();
            $combine = $image_path . '' . $image_name;

            $user->setProfileImage($combine);

            $this->addFlash('success', 'Profile image updated');
            $this->entityManager->flush();

        }

        return $this->render('profile/profile.html.twig', [
            'userForm' => $profileForm->createView(),
            'userProfileForm' => $profileImageForm->createView(),
            'addressForm' => $addressForm->createView(),

        ]);
    }

//    /**
//     * @Route("/profile", name="edit_profile")
//     */
//    public function editProfileImage(Request $request): Response
//    {
//        /** @var User $user */
//        $user = $this->getUser();
//
//        $form = $this->createForm(UpdateProfileImageType::class, $user);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//
//            $this->addFlash('success', 'Profile updated');
//            $this->entityManager->flush();
//
//            return $this->redirectToRoute('profile');
//        }
//
//        return $this->render('profile/profile.html.twig', [
//            'Imageform' => $form->createView(),
//
//        ]);
//    }

}
