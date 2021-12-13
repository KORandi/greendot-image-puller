<?php

namespace Greendot\ImagePullerClient\Controller;

use Greendot\ImagePullerClient\Service\JwtService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/greendot/image-puller-client")
 */
class Api extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(): JsonResponse
    {
        return $this->json(["status" => 200]);
    }

    /**
     * @Route ("/", name="receive-file", methods={"POST"})
     */
    public function receiveFile(
        Request     $request,
        JwtService  $jwtService
    ): JsonResponse
    {
        $token = $request->headers->get("jwt-token");

        if (is_null($token) || !$jwtService->isValid($token)) {
            return $this->json(["status" => 400], 400);
        }

        return $this->json(["status" => 200]);
    }
}