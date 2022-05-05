<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

abstract class QuestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, string $class)
    {
        parent::__construct($registry, $class);
    }

    public function getQuestions(): array
    {
        $builder = $this->createQueryBuilder('question');

        $return = $builder->getQuery()->getResult();

        return $return;
    }
}
