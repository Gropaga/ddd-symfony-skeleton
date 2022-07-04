<?php

declare(strict_types=1);

namespace App\Banking\Infrastructure\Persistence;

use App\Banking\Domain\Client;
use App\Banking\Domain\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\UuidInterface;

final class DoctrineClientRepository implements ClientRepository
{
    public function __construct(private EntityManagerInterface $entityManger)
    {
    }

    public function all(): array
    {
        $queryBuilder = $this->entityManger->createQueryBuilder();
        $queryBuilder
            ->select('Client, BankAccounts')
            ->from(Client::class, 'Client')
            ->leftJoin('Client.bankAccounts', 'BankAccounts');

        $query = $queryBuilder->getQuery();

        return $query->getArrayResult();
    }


    public function save(Client $client): void
    {
        $this->entityManger->persist($client);
        $this->entityManger->flush();
    }

    public function get(UuidInterface $id): Client
    {
        $queryBuilder = $this->entityManger->createQueryBuilder();
        $queryBuilder
            ->select('Client, BankAccounts')
            ->from(Client::class, 'Client')
            ->leftJoin('Client.bankAccounts', 'BankAccounts')
            ->where('Client.id = :id')
            ->setParameter(':id', $id);

        $query = $queryBuilder->getQuery();

        $client = $query->getSingleResult();
        assert($client instanceof Client);
        return $client;
    }

    public function remove(UuidInterface $id): void
    {
        $client = $this->get($id);
        $this->entityManger->remove($client);
        $this->entityManger->flush();
    }
}