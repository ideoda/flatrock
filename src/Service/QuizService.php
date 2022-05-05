<?php

namespace App\Service;

use App\Entity\Question;
use App\Entity\QuizResult;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

class QuizService
{
    protected EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createResult(array $questions, array $answers, array $personalInfo): QuizResult
    {
        $totalScore = $this->getTotalScore($questions, $answers);

        $numberOfUnansweredQuestions = $this->getNumberOfUnansweredQuestions($questions, $answers);

        $result = new QuizResult();

        $result
            ->setEmail($personalInfo['email'])
            ->setFirstName($personalInfo['firstName'])
            ->setLastName($personalInfo['lastName'])
            ->setSubmitDate((new DateTime('now')))
            ->setTotalScore($totalScore)
            ->setNumberOfUnansweredQuestions($numberOfUnansweredQuestions)
        ;

        $this->entityManager->persist($result);
        $this->entityManager->flush($result);

        return $result;
    }

    public function getTotalScore(array $questions, array $answers): int
    {
        $totalScore = 0;
        foreach ($questions as $key => $question) {
            /** @var Question $question */
            if ($question->getGoodAnswer() === $answers[$key]) {
                $totalScore++;
            }
        }

        return $totalScore;
    }

    public function getNumberOfUnansweredQuestions(array $questions, array $answers): int
    {
        $countAnswers = count(array_filter($answers, static function (?int $answer) {
            return null !== $answer;
        }));

        return count($questions) - $countAnswers;
    }
}
