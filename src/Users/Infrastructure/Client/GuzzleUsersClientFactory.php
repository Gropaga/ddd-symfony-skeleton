<?php

declare(strict_types=1);

namespace App\Users\Infrastructure\Client;

use App\Users\Domain\UsersClient;
use GuzzleHttp\Client;

final class GuzzleUsersClient implements UsersClient
{
    private Client $guzzle;
    private string $resource;

    public function __construct(
        Client $guzzle,
        string $resource
    ) {
        $this->guzzle = $guzzle;
        $this->resource = $resource;
    }

    public function getAllClients(): array
    {

    }
}