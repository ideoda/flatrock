<?php

namespace App\Repository;

use App\Entity\TripleQuestion;
use Doctrine\Persistence\ManagerRegistry;

class TripleQuestionRepository extends QuestionRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TripleQuestion::class);
    }
}
