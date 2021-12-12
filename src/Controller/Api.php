<?php

namespace Greendot\ImagePullerClient\Controller;

use Symfony\Component\Routing\Annotation\Route;

class Api extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    /**
     * @Route("/api/image-puller")
     */
    public function index() {
        return $this->json(["status" => 200]);
    }
}