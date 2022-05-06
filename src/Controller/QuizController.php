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
 * @Route("/quiz", name="quiz")
 */
class QuizController extends AbstractController
{
    protected EntityManagerInterface $entityManager;

    protected QuizService $quizService;

    public function __construct(EntityManagerInterface $entityManager, QuizService $quizService)
    {
        $this->entityManager = $entityManager;
        $this->quizService = $quizService;
    }

    /**
     * @Route("/", name="_questions")
     */
    public function questions(Request $request): Response
    {
        $session = $request->getSession();

        $session->remove('questions');
        $session->remove('answers');
        $session->remove('personalData');

        $isBinary = $request->getSession()->get('binary', true);

        $repository = $this->entityManager->getRepository(BinaryQuestion::class);
        $formType = BinaryQuestionType::class;
        if (!$isBinary) {
            $repository = $this->entityManager->getRepository(TripleQuestion::class);
            $formType = TripleQuestionType::class;
        }

        $questions = $repository->getQuestions();

        if (count($questions) < 10) {
            return $this->render('quiz/no_enough_questions.html.twig',
                [
                    'isBinary' => $isBinary,
                ]);
        }

        $form = $this->createForm($formType, null, ['questions' => $questions]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $answers = $form->getData();

            $session = $request->getSession();
            $session->set('questions', $questions);
            $session->set('answers', array_values($answers));

            return $this->redirectToRoute('quiz_personal_data');
        }

        return $this->render('quiz/questions.html.twig',
            [
                'form' => $form->createView(),
                'questions' => $questions,
                'isBinary' => $isBinary,
            ]);
    }

    /**
     * @Route("/personal", name="_personal_data")
     */
    public function personalData(Request $request): Response
    {
        $session = $request->getSession();
        if (!$session->get('questions') || !$session->get('answers') || $session->get('personalData')) { //todo maybe we could use voters
            return $this->redirectToRoute('homepage');
        }

        $form = $this->createForm(PersonalDataType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $session->set('personalData', $form->getData());

            return $this->redirectToRoute('quiz_results');
        }

        return $this->render('quiz/personal_data.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/results", name="_results")
     */
    public function results(Request $request): Response
    {
        $session = $request->getSession();

        $questions = $session->get('questions');
        $answers = $session->get('answers');
        $personalData = $session->get('personalData');

        if (!$questions || !$answers || !$personalData) { //todo maybe we could use voters
            return $this->redirectToRoute('homepage');
        }

        $result = $this->quizService->createResult($questions, $answers, $personalData);

        $isBinary = $request->getSession()->get('binary', true);



        $hallOfFame =  $this->entityManager->getRepository(QuizResult::class)->getHallOfFame();


        return $this->render('quiz/result.html.twig', [
            'yourResult' => $result,
            'hallOfFame' => $hallOfFame,
        ]);
    }

    /**
     * @Route("/evaluate/{id}", name="_evaluate", options={"expose"=true})
     */
    public function evaluate(Request $request, Question $question): JsonResponse
    {
        return new JsonResponse([$question->getGoodAnswer()]);
    }
}
