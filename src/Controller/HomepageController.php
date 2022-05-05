<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController
{
    /**
     * @Route("/", name="homepage")
     * @Template
     */
    public function index()
    {
        return [];
    }
}
