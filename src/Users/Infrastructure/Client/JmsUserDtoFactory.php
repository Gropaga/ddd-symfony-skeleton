<?php

declare(strict_types=1);

namespace App\Users\Infrastructure\Client;

use App\Users\Domain\Dto\UserDto;
use JMS\Serializer\SerializerInterface;

final class JmsUserDtoFactory implements UserDtoFactory
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function fromArray(array $array): UserDto
    {
        return $this->serializer->deserialize(json_encode($array), UserDto::class, 'json');
    }
}