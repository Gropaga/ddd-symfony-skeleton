<?php

declare(strict_types=1);

namespace App\Banking\Application\Services;

use App\Banking\Application\Dto\NewClientDto;
use App\Banking\Application\Factory\ClientFactory;
use App\Banking\Domain\ClientRepository;

final class CreateNewClientService
{
    private ClientRepository $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function exec(NewClientDto $newClientDto): string
    {
        $client = ClientFactory::fromDto($newClientDto);
        $this->clientRepository->save($client);

        return $client->id()->toString();
    }
}