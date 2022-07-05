<?php

namespace App\Users\Domain;

use App\Users\Domain\Dto\UserDto;

interface UsersClient
{
    public function getFirstUser(): UserDto;
}