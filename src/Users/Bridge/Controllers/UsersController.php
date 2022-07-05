<?php

declare(strict_types=1);

namespace App\Users\Bridge\Controllers;

use App\Users\Application\SendNotificationToFirstUserService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

/**
 * @Route("/api/users")
 * @OA\Tag(name="Users endpoints")
 */
final class UsersController
{
    private SendNotificationToFirstUserService $sendNotificationToFirstUserService;

    public function __construct(
        SendNotificationToFirstUserService $sendNotificationToFirstUserService
    )
    {
        $this->sendNotificationToFirstUserService = $sendNotificationToFirstUserService;
    }

    /**
     * @Route("/get-all", methods={"GET"})
     */
    public function get(): JsonResponse
    {
        $this->sendNotificationToFirstUserService->exec();

        return JsonResponse::fromJsonString('OK');
    }
}