<?php

declare(strict_types=1);

namespace App\Users\Domain\Dto;

final class UserDto
{
    public int $id;
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $phone;
}