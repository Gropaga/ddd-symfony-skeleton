<?php

declare(strict_types=1);

namespace App\Application\Factory;

use App\Application\Dto\NewBankAccountDto;
use App\Application\Dto\NewClientDto;
use App\Domain\BankAccount;
use App\Domain\Client;

final class ClientFactory
{
    static function fromDto(NewClientDto $clientDto): Client
    {
        $client =  new Client(
            $clientDto->name,
            $clientDto->surname,
            $clientDto->email,
        );

        $bankAccounts = $clientDto->bankAccounts ?? [];
        if (false === empty($bankAccounts)) {
            /** @var NewBankAccountDto $bankAccount */
            foreach ($bankAccounts as $bankAccount) {
                $client->addBankAccount(new BankAccount(
                    $bankAccount->bic,
                    $bankAccount->balance,
                ));
            }
        }

        return $client;
    }
}