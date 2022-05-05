<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BinaryQuestionRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 */
class BinaryQuestion extends Question
{
}
