<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

class UpdateProfileImagePatientType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('profileImage', FileType::class, [
                'label' => false , 'mapped' => false, 'required' => false, 'constraints' =>
                    new File([
                        'maxSize' => '5m',
                        'mimeTypes' => [
                            'image/*',
                        ],
                    ])
            ]);

    }

}