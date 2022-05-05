<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TripleQuestionRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 */
class TripleQuestion extends Question
{
    /**
     * @ORM\Column(type="json")
     */
    protected array $answers = [];

    public function getAnswers(): array
    {
        return $this->answers;
    }

    public function setAnswers(array $answers): void
    {
        $this->answers = $answers;
    }
}
