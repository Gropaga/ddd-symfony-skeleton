<?php

declare(strict_types=1);

namespace App\Banking\Application\Factory;

use App\Banking\Application\Dto\BankAccountDto;
use App\Banking\Application\Dto\ClientDto;
use App\Banking\Domain\BankAccount;
use App\Banking\Domain\Client;

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