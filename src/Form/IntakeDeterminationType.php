<?php


namespace App\Form;

use App\Entity\Treatment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class IntakeDeterminationType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('existingComplaints', TextType::class)
            ->add('weightLoss', TextType::class)
            ->add('geneticDisorders', TextType::class)
            ->add('formerOperations', TextType::class)
            ->add('chronicDisorders', TextType::class)
            ->add('intoxication', ChoiceType::class, [
                'placeholder' => 'Show all',
                'label' => 'Intoxications / abuses',
                'choices' => [
                    'Alcohol' => 'Alcohol',
                    'Smoking' => 'Smoking',
                    'Other..' => 'Other',
                ],
                'attr' => [
                    'class' => 'select2',
                ],
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Treatment::class,
        ]);
    }
}