<?php

declare(strict_types=1);

namespace App\Application\Factory;

use App\Application\Dto\BankAccountDto;
use App\Application\Dto\ClientDto;
use App\Domain\BankAccount;
use App\Domain\Client;

final class ClientDtoFactory
{
    static function fromClient(Client $client): ClientDto
    {
        $clientDto = new ClientDto();
        $clientDto->id = $client->id()->toString();
        $clientDto->name = $client->name();
        $clientDto->surname = $client->surname();
        $clientDto->email = $client->email();
        $clientDto->bankAccounts = [];

        /** @var BankAccount $bankAccount */
        foreach ($client->allBankAccounts() as $bankAccount) {
            $bankAccountDto = new BankAccountDto();

            $bankAccountDto->id = $bankAccount->id()->toString();
            $bankAccountDto->bic = $bankAccount->bic();
            $bankAccountDto->balance = $bankAccount->balance();

            $clientDto->bankAccounts[] = $bankAccountDto;
        }

        return $clientDto;
    }
}