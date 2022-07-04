<?php

declare(strict_types=1);

namespace App\Domain;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Ramsey\Uuid\UuidInterface;

final class Client
{
    private UuidInterface $id;
    private Collection $bankAccounts;

    public function __construct(
        private string $name,
        private string $surname,
        private string $email
    ) {
        $this->bankAccounts = new ArrayCollection();
    }

    public function id(): UuidInterface
    {
        return $this->id;
    }

    public function updateName(string $name): void
    {
        $this->name = $name;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function updateSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    public function surname(): string
    {
        return $this->surname;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function updateEmail(string $email): void
    {
        $this->email = $email;
    }

    public function addBankAccount(BankAccount $bankAccount): void
    {
        $this->bankAccounts->add($bankAccount);
    }

    public function removeBankAccount(UuidInterface $bankAccountId): void
    {
        /** @var BankAccount $bankAccount */
        foreach ($this->bankAccounts as $bankAccount) {
            if ($bankAccount->id()->equals($bankAccountId)) {
                $this->bankAccounts->removeElement($bankAccount);
            }
        }
    }

    public function allBankAccounts(): Collection
    {
        return $this->bankAccounts;
    }
}