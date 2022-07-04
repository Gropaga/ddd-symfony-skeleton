<?php

declare(strict_types=1);

namespace App\Bridge\Controller\Rest;

use App\Application\Commands\CreateClientCommand;
use App\Application\Dto\NewBankAccountDto;
use App\Application\Dto\NewClientDto;
use App\Application\Factory\ClientDtoFactory;
use App\Application\Services\DeleteClientBankAccountService;
use App\Application\Services\DeleteClientService;
use App\Bridge\Deserializer\Deserialize;
use App\Domain\ClientRepository;
use JMS\Serializer\SerializerInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Annotations as OA;
use PHPUnit\Util\Json;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/client")
 * @OA\Tag(name="Client endpoints")
 */
final class ClientController
{
    use HandleTrait;

    private SerializerInterface $serializer;
    private DeleteClientService $deleteClientService;
    private ClientRepository $clientRepository;
    private DeleteClientBankAccountService $deleteClientBankAccountService;

    public function __construct(
        MessageBusInterface $commandBus,
        SerializerInterface $serializer,
        DeleteClientService $deleteClientService,
        DeleteClientBankAccountService $deleteClientBankAccountService,
        ClientRepository $clientRepository
    )
    {
        $this->messageBus = $commandBus;
        $this->serializer = $serializer;
        $this->deleteClientService = $deleteClientService;
        $this->clientRepository = $clientRepository;
        $this->deleteClientBankAccountService = $deleteClientBankAccountService;
    }

    /**
     * @Route("/{id}", methods={"GET"})
     */
    public function get(string $id): JsonResponse
    {
        $client = $this->clientRepository->get(Uuid::fromString($id));
        $clientDto = ClientDtoFactory::fromClient($client);

        return new JsonResponse(
            data: $this->serializer->serialize($clientDto, 'json'),
            json: true,
        );
    }

    /**
     * @Route("/create", methods={"POST"})
     * @OA\RequestBody(@Model(type=NewClientDto::class))
     * @Deserialize(NewClientDto::class, validate=true, param="newClientDto")
     */
    public function create(NewClientDto $newClientDto): JsonResponse
    {
        $this->messageBus->dispatch(
            new CreateClientCommand($newClientDto)
        );

        return new JsonResponse(
            [
                'OK'
            ]
        );
    }

    /**
     * @Route("/delete/{id}", methods={"DELETE"})
     * @Deserialize(NewClientDto::class, validate=true, param="clientDto")
     */
    public function delete(string $id): JsonResponse
    {
        $this->deleteClientService->exec(Uuid::fromString($id));

        return new JsonResponse(
            [
                'OK'
            ]
        );
    }

    /**
     * @Route("/delete-bank-account/{clientId}/{bankAccountId}", methods={"DELETE"})
     * @Deserialize(NewClientDto::class, validate=true, param="clientDto")
     */
    public function deleteBankAccount(string $clientId, string $bankAccountId): JsonResponse
    {
        $this->deleteClientBankAccountService->exec(
            Uuid::fromString($clientId),
            Uuid::fromString($bankAccountId),
        );

        return new JsonResponse(
            [
                'OK'
            ]
        );
    }
}