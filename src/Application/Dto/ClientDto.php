<?php

declare(strict_types=1);

namespace App\Application\Dto;

final class ClientDto
{
    public string $id;
    public string $name;
    public string $surname;
    public string $email;
    public array $bankAccounts;
}