<?php

declare(strict_types=1);

namespace App\Banking\Application\Services;

use App\Banking\Domain\ClientRepository;
use Ramsey\Uuid\UuidInterface;

final class DeleteClientService
{
    public function __construct(private ClientRepository $clientRepository)
    {
    }

    public function exec(UuidInterface $id): void
    {
        $this->clientRepository->remove($id);
    }
}