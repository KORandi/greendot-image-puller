<?php

namespace Greendot\ImagePullerClient\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/gd")
 */
class Api extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index() {
        return $this->json(["status" => 200]);
    }
}