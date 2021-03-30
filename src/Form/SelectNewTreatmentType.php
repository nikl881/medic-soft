<?php

namespace App\Form;

use App\Entity\Treatment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SelectNewTreatmentType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('stage', ChoiceType::class, [
                'choices'  => [
                    'Stage 1 - Intake' => 1,
                    'Stage 2 - Diagnosis' => 2,
                    'Stage 3 - Treatment' => 3,
                    'Stage 4 - Aftercare' => 4,
                ]
            ])
            ->add('start_date', DateTimeType::class)
            ->add('submit', SubmitType::class);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Treatment::class,
        ]);
    }
}