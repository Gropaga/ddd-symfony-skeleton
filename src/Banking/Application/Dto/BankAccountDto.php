<?php

declare(strict_types=1);

namespace App\Banking\Application\Dto;

use Decimal\Decimal;

final class BankAccountDto
{
    public string $id;
    public string $bic;
    public Decimal $balance;
}