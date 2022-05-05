<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 */
class QuizResult
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected int $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected int $totalScore;

    /**
     * @ORM\Column(type="integer")
     */
    protected string $numberOfUnansweredQuestions;

    /**
     * @ORM\Column(type="text")
     */
    protected string $firstName;

    /**
     * @ORM\Column(type="text")
     */
    protected string $lastName;

    /**
     * @ORM\Column(type="text")
     * @Assert\Email()
     */
    protected string $email;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     */
    protected DateTime $submitDate;

    public function getId(): int
    {
        return $this->id;
    }

    public function getTotalScore(): int
    {
        return $this->totalScore;
    }

    public function setTotalScore(int $totalScore): QuizResult
    {
        $this->totalScore = $totalScore;
        return $this;
    }

    public function getNumberOfUnansweredQuestions(): string
    {
        return $this->numberOfUnansweredQuestions;
    }

    public function setNumberOfUnansweredQuestions(string $numberOfUnansweredQuestions): QuizResult
    {
        $this->numberOfUnansweredQuestions = $numberOfUnansweredQuestions;
        return $this;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): QuizResult
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): QuizResult
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): QuizResult
    {
        $this->email = $email;
        return $this;
    }

    public function getSubmitDate(): DateTime
    {
        return $this->submitDate;
    }

    public function setSubmitDate(DateTime $submitDate): QuizResult
    {
        $this->submitDate = $submitDate;
        return $this;
    }
}
