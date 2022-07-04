<?php

declare(strict_types=1);

namespace App\Banking\Domain;

use Ramsey\Uuid\UuidInterface;

final class BankAccount
{
    private UuidInterface $id;

    public function __construct(
        private string $bic,
        private string $balance
    ) {}

    public function id(): UuidInterface
    {
        return $this->id;
    }

    public function bic(): string
    {
        return $this->bic;
    }

    public function balance(): string
    {
        return $this->balance;
    }
}