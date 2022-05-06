<?php

namespace App\Form;

use App\Entity\BinaryQuestion;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class BinaryQuestionType extends QuestionType
{
    protected function addQuestion(FormBuilderInterface $builder, string $name, BinaryQuestion $question): void
    {
        $builder->add($name, ChoiceType::class, [
            'label' => $question->getQuestion(),
            'expanded' => true,
            'choices' => [
                'Yes' => 0,
                'No' => 1,
            ],
            'choice_attr' => function() {
                return ['class' => 'mx-3'];
            },
            'label_attr' =>  ['class' => 'mb-5'],
            'attr' =>  [
                'data-id' => $question->getId(),
                'class' => 'questioninputs',
            ],
        ]);
    }
}
