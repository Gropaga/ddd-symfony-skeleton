<?php

declare(strict_types=1);

namespace App\Application\Commands\Handlers;

use App\Application\Commands\CreateClientCommand;
use App\Application\Factory\ClientFactory;
use App\Domain\ClientRepository;

final class CreateClientCommandHandler
{
    public function __construct(private ClientRepository $clientRepository)
    {
    }

    public function __invoke(CreateClientCommand $command)
    {
        $client = ClientFactory::fromDto(
            $command->clientDto()
        );

        $this->clientRepository->save($client);
    }
}