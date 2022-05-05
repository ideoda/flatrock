<?php

namespace App\Repository;

use App\Entity\BinaryQuestion;
use Doctrine\Persistence\ManagerRegistry;

class BinaryQuestionRepository extends QuestionRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BinaryQuestion::class);
    }
}
