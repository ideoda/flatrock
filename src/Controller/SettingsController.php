<?php

namespace App\Controller;

use App\Entity\BinaryQuestion;
use App\Entity\TripleQuestion;
use App\Form\BinaryQuestionType;
use App\Form\PersonalDataType;
use App\Form\SettingsType;
use App\Form\TripleQuestionType;
use App\Service\QuizService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/settings", name="settings")
 */
class SettingsController extends AbstractController
{
    /**
     * @Route("", name="_index")
     */
    public function settings(Request $request): Response
    {
        $isBinary = $request->getSession()->get('binary', true);

        $form = $this->createForm(SettingsType::class, ['binary' => $isBinary]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $binary = (bool)$form->get('binary')->getData();
            $request->getSession()->set('binary', $binary);

            return $this->redirectToRoute('quiz_questions');
        }

        return $this->render('quiz/settings.html.twig',
            [
                'form' => $form->createView(),
            ]);
    }
}
