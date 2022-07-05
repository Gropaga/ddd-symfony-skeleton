<?php

declare(strict_types=1);

namespace App\Users\Domain\Factory;

use App\Users\Domain\Dto\UserDto;
use App\Users\Domain\User;

final class UserFactory
{
    static function fromDto(UserDto $userDto): User
    {
        return new User(
            $userDto->id,
            $userDto->firstName,
            $userDto->lastName,
            $userDto->email,
            $userDto->phone,
        );
    }
}