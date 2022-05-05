<?php

namespace App\Repository;

use App\Entity\QuizResult;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class QuizResultRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuizResult::class);
    }

    public function getHallOfFame()
    {
        $builder = $this->createQueryBuilder('result');

        $builder->addOrderBy('result.totalScore', 'DESC');
        $builder->addOrderBy('result.numberOfUnansweredQuestions', 'ASC');
        $builder->setMaxResults(20);

        return $builder->getQuery()->getResult();
    }
}
