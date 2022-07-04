<?php

declare(strict_types=1);

namespace App\Banking\Application\Factory;

use App\Banking\Application\Dto\NewBankAccountDto;
use App\Banking\Application\Dto\NewClientDto;
use App\Banking\Domain\BankAccount;
use App\Banking\Domain\Client;

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