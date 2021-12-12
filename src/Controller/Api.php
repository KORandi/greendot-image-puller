<?php

namespace Greendot\ImagePullerClient\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Api extends AbstractController
{
    public function index() {
        return $this->json(["status" => 200]);
    }
}