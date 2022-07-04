<?php

declare(strict_types=1);

namespace App\Banking\Application\Commands\Handlers;

use App\Banking\Application\Commands\CreateClientCommand;
use App\Banking\Application\Factory\ClientFactory;
use App\Banking\Domain\ClientRepository;

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