<?php

namespace Greendot\ImagePullerClient\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class Api extends AbstractController
{
    /**
     * @Route("/qqq", name="qqq")
     */
    public function index() {
        return $this->json(["status" => 200]);
    }
}