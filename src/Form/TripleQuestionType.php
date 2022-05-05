<?php

namespace App\Form;

use App\Entity\BinaryQuestion;
use App\Entity\TripleQuestion;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class TripleQuestionType extends QuestionType
{
    protected function addQuestion(FormBuilderInterface $builder, string $name, TripleQuestion $question): void
    {
        $builder->add($name, ChoiceType::class, [
            'label' => $question->getQuestion(),
            'expanded' => true,
            'choices' => array_flip($question->getAnswers()),
            'choice_attr' => function() {
                return ['class' => 'mx-3'];
            },
            'label_attr' =>  ['class' => 'mb-5'],
        ]);
    }
}
