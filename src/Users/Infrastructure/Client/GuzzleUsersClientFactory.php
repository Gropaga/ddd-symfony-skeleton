<?php

declare(strict_types=1);

namespace App\Users\Infrastructure\Client;

use App\Users\Domain\UsersClient;
use GuzzleHttp\Client;

final class GuzzleUsersClientFactory
{
    public function create(UserDtoFactory $userDtoFactory, string $resource): UsersClient
    {
        return new GuzzleUsersClient(new Client(), $userDtoFactory, $resource);
    }
}