<?php

declare(strict_types=1);

namespace App\Application\Dto;

final class NewBankAccountDto
{
    public string $bic;
    public string $balance;
}