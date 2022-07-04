<?php

declare(strict_types=1);

namespace App\Users\Infrastructure;

use App\Users\Domain\UsersClient;

final class GuzzleUsersClient implements UsersClient
{
    public function getAllClients(): array
    {
        
    }
}