<?php

declare(strict_types=1);

namespace App\Banking\Application\Services;

use App\Banking\Application\Dto\ClientDto;
use App\Banking\Domain\ClientRepository;
use Ramsey\Uuid\Uuid;

final class UpdateClientService
{
    private ClientRepository $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function exec(ClientDto $clientDto): void
    {
        $client = $this->clientRepository->get(
            Uuid::fromString($clientDto->id)
        );
        $client->updateName($clientDto->name);
        $client->updateSurname($clientDto->surname);
        $client->updateEmail($clientDto->email);

        $this->clientRepository->save($client);
    }
}