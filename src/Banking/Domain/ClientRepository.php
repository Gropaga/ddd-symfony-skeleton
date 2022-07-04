<?php

namespace App\Banking\Domain;

use Ramsey\Uuid\UuidInterface;

interface ClientRepository
{
    public function save(Client $client): void;

    public function get(UuidInterface $id): Client;

    public function remove(UuidInterface $id): void;

    public function all(): array;
}