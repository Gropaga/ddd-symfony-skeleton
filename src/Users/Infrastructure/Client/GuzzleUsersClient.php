<?php

declare(strict_types=1);

namespace App\Users\Infrastructure\Client;

use App\Users\Domain\Dto\UserDto;
use App\Users\Domain\UsersClient;
use GuzzleHttp\Client;
use JMS\Serializer\SerializerInterface;
use RuntimeException;

final class GuzzleUsersClient implements UsersClient
{
    private Client $guzzle;
    private UserDtoFactory $dtoFactory;
    private string $resource;

    public function __construct(
        Client $guzzle,
        UserDtoFactory $dtoFactory,
        string $resource
    ) {
        $this->guzzle = $guzzle;
        $this->dtoFactory = $dtoFactory;
        $this->resource = $resource;
    }

    public function getFirstUser(): UserDto
    {
        $response = $this->guzzle->get($this->resource);

        if (null === $response) {
            throw new RuntimeException('No response received');
        }

        $body = $response->getBody();
        if (null === $body) {
            throw new RuntimeException('No body available');
        }

        $userArray = json_decode($body->getContents(), true);

        return $this->dtoFactory->fromArray($userArray['users'][0]);
    }
}