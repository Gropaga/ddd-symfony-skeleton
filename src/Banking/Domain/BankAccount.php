<?php

declare(strict_types=1);

namespace App\Banking\Domain;

use Decimal\Decimal;
use Ramsey\Uuid\UuidInterface;

final class BankAccount
{
    private UuidInterface $id;

    public function __construct(
        private string $bic,
        private Decimal $balance
    ) {}

    public function id(): UuidInterface
    {
        return $this->id;
    }

    public function bic(): string
    {
        return $this->bic;
    }

    public function balance(): Decimal
    {
        return $this->balance;
    }
}