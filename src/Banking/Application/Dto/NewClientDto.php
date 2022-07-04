<?php

declare(strict_types=1);

namespace App\Banking\Application\Dto;

final class NewClientDto
{
    public string $name;
    public string $surname;
    public string $email;
    public array $bankAccounts;
}