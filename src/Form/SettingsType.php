<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SettingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('binary', ChoiceType::class, [
            'choices' => [
                'Yes' => true,
                'No' => false,
            ],
        ]);

        $builder->add('submit', SubmitType::class, [
            'label' => 'save',
            'attr' => [
                'class' => 'btn btn-success',
            ],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults(
                [
                    'required' => true,
                ]
            )
        ;
    }
}
