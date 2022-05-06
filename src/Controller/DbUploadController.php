<?php

namespace App\Controller;

use App\Entity\BinaryQuestion;
use App\Entity\Question;
use App\Entity\QuizResult;
use App\Entity\TripleQuestion;
use App\Form\BinaryQuestionType;
use App\Form\PersonalDataType;
use App\Form\TripleQuestionType;
use App\Service\QuizService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/upload", name="upload")
 */
class DbUploadController extends AbstractController
{
    protected EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/", name="_index")
     */
    public function index(): Response
    {
        for ($i = 0; $i < 10; $i++) {
            $question = new BinaryQuestion();
            $question->setQuestion('Question ' . ($i + 1) . ' text: example test binary');
            $question->setGoodAnswer(rand(0,1));
            $this->entityManager->persist($question);
        }

        for ($i = 0; $i < 10; $i++) {
            $question = new TripleQuestion();
            $question->setQuestion('Question ' . ($i + 1) . ' text: example test triple');
            $question->setAnswers([
                'answer one',
                'answer two',
                'answer three',
            ]);
            $question->setGoodAnswer(rand(0,2));
            $this->entityManager->persist($question);
        }

        $this->entityManager->flush($question);

        return new Response('Uploaded');
    }
}
