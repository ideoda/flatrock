<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $questions = $options['questions'];

        foreach ($questions as $key => $question) {
            $name = 'question' . $key;

            $this->addQuestion($builder, $name, $question);

            $builder->add('button'.($key+1), ButtonType::class, [
                'label' => 'Next',
                'attr' => [
                    'class' => 'btn btn-success mt-5',
                ],
            ]);
        }

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
                    'required' => false,
                ]
            )
        ;

        $resolver->setRequired('questions');
    }
}
