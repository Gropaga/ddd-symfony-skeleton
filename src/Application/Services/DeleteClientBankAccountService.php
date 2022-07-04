<?php

declare(strict_types=1);

namespace App\Application\Services;

use App\Domain\ClientRepository;
use Ramsey\Uuid\UuidInterface;

final class DeleteClientBankAccountService
{
    public function __construct(private ClientRepository $clientRepository)
    {
    }

    public function exec(UuidInterface $clientId, UuidInterface $bankAccountId): void
    {
        $client = $this->clientRepository->get($clientId);
        $client->removeBankAccount($bankAccountId);

        $this->clientRepository->save($client);
    }
}