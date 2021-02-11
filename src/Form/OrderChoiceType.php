<?php

namespace App\Form;

use App\Repository\UserRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class OrderChoiceType extends AbstractType
{

    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('lastName', ChoiceType::class, [
            'choices' => [
                'ASC' => "ASC",
                'DESC' => "DESC",
            ]]);
        $builder->add('save', SubmitType::class);

    }

}