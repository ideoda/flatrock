<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\InheritanceType("SINGLE_TABLE")
 */
abstract class Question
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected int $id;

    /**
     * @ORM\Column(type="string")
     */
    protected string $question;

    /**
     * @ORM\Column(type="smallint")
     */
    protected int $goodAnswer;

    public function getId(): int
    {
        return $this->id;
    }

    public function getQuestion(): string
    {
        return $this->question;
    }

    public function setQuestion(string $question): void
    {
        $this->question = $question;
    }

    public function getGoodAnswer(): int
    {
        return $this->goodAnswer;
    }

    public function setGoodAnswer(int $goodAnswer): void
    {
        $this->goodAnswer = $goodAnswer;
    }
}
