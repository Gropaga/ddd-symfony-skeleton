<?php

declare(strict_types=1);

namespace App\Banking\Application\Dto;

final class BankAccountDto
{
    public string $id;
    public string $bic;
    public string $balance;
}