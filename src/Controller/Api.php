<?php

namespace Greendot\ImagePullerClient\Controller;

use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManager;
use Greendot\ImagePullerClient\Service\ImageService;
use Greendot\ImagePullerClient\Service\JwtService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class Api extends AbstractController
{
    private JwtService $jwtService;
    private ImageService $imageService;
    private EntityManager $entityManager;

    public function __construct(
        JwtService   $jwtService,
        ImageService $imageService,
        EntityManager $entityManager
    )
    {
        $this->jwtService = $jwtService;
        $this->imageService = $imageService;
        $this->entityManager = $entityManager;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function saveImage(
        Request      $request
    ): JsonResponse
    {
        if (!$this->isTokenValid($request)) {
            return $this->json(["status" => 401, "msg" => "Access denied."], 401);
        }

        if (!$this->isFileInRequest($request)) {
            return $this->json([
                "status" => 400,
                "msg" => "No file uploaded."
            ], 400);
        }

        try {
            $schemaManager = $this->entityManager->getConnection()->createSchemaManager();
            if (!$schemaManager->tablesExist(["image"])) {
                return $this->json([
                    "status" => 404,
                    "msg" => "Table does not exist."
                ], 404);
            }
        } catch(\Exception $e) {
            return $this->json([
                "status" => 404,
                "msg" => "Cannot connect to the db."
            ], 404);
        }

        $this->saveFiles($request);
        return $this->json(["status" => 200]);
    }

    public function getSrc(
        Request      $request,
        string       $src
    ): JsonResponse
    {
        if (!$this->isTokenValid($request)) {
            return $this->json(["status" => 401, "msg" => "Access denied."], 401);
        }

        return $this->json(["status" => 200, "data" => $src]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function validate(
        Request      $request
    ): JsonResponse {
        if (!$this->isTokenValid($request)) {
            return $this->json(["status" => 401, "msg" => "Access denied."], 401);
        }
        return $this->json(["status" => 200]);
    }

    private function isTokenValid(Request $request): bool
    {
        $token = $request->headers->get("jwt-token");
        return !is_null($token) && $this->jwtService->isValid($token);
    }

    private function isFileInRequest(Request $request): bool
    {
        $files = $request->files->all();
        return sizeof($files) != 0;
    }

    private function saveFiles(Request $request)
    {
        $files = $request->files->all();

        /**
         * @var string $key
         * @var UploadedFile $file
         */
        foreach ($files as $key => $file) {
            $this->imageService->uploadImage($file);
        }
    }
}