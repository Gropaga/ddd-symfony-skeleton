<?php

namespace App\Users\Infrastructure\Client;

use App\Users\Domain\Dto\UserDto;

interface UserDtoFactory
{
    public function fromArray(array $array): UserDto;
}