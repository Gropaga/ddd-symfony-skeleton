<?php

declare(strict_types=1);

namespace App\Bridge\Controller\Web;

use App\Application\Dto\NewBankAccountDto;
use App\Application\Dto\NewClientDto;
use App\Application\Factory\ClientDtoFactory;
use App\Application\Services\CreateNewClientService;
use App\Application\Services\UpdateClientService;
use App\Bridge\Controller\Web\Form\EditClientType;
use App\Bridge\Controller\Web\Form\NewBankAccountType;
use App\Bridge\Controller\Web\Form\NewClientType;
use App\Domain\ClientRepository;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ClientController extends AbstractController
{
    private CreateNewClientService $createNewClientService;
    private ClientRepository $clientRepository;
    private UpdateClientService $updateClientService;

    public function __construct(
        CreateNewClientService $createNewClientService,
        UpdateClientService $updateClientService,
        ClientRepository $clientRepository,
    )
    {
        $this->createNewClientService = $createNewClientService;
        $this->clientRepository = $clientRepository;
        $this->updateClientService = $updateClientService;
    }

    /**
     * @Route("/", name="landing_page")
     */
    public function index(): Response
    {
        $newClientDto = new NewClientDto();
        $form = $this->createForm(NewClientType::class, $newClientDto, [
            'action' => $this->generateUrl('create_client'),
            'method' => 'POST',
        ]);

        $clients = $this->clientRepository->all();

        return $this->renderForm('client/index.html.twig', [
            'form' => $form,
            'clients' => $clients,
        ]);
    }

    /**
     * @Route("/create-client", name="create_client")
     */
    public function create(Request $request): Response
    {
        $newClientDto = new NewClientDto();
        $form = $this->createForm(NewClientType::class, $newClientDto);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $newClientDto = $form->getData();

            $id = $this->createNewClientService->exec($newClientDto);

            return $this->redirectToRoute('view_client', ['id' => $id]);
        }

        return $this->redirectToRoute('landing_page');
    }

    /**
     * @Route("/client/view/{id}", name="view_client", methods={"GET"})
     */
    public function view(string $id): Response
    {
        $client = $this->clientRepository->get(Uuid::fromString($id));
        $clientDto = ClientDtoFactory::fromClient($client);

        $form = $this->createForm(EditClientType::class, $clientDto, [
            'action' => $this->generateUrl('edit_client', ['id' => $id]),
            'method' => 'POST',
        ]);

        $bankAccountForm = $this->createForm(
            NewBankAccountType::class,
            new NewBankAccountDto(),
            [
                'action' => $this->generateUrl('add_bank_account', ['id' => $id]),
                'method' => 'POST',
            ]
        );

        return $this->renderForm('client/edit.html.twig', [
            'form' => $form,
            'bankAccounts' => $clientDto->bankAccounts,
            'bankAccountForm' => $bankAccountForm,
        ]);
    }

    /**
     * @Route("/edit-client/{id}", name="edit_client", methods={"POST"})
     */
    public function edit(Request $request, string $id): Response
    {
        $client = $this->clientRepository->get(Uuid::fromString($id));
        $clientDto = ClientDtoFactory::fromClient($client);

        $form = $this->createForm(EditClientType::class, $clientDto, [
            'action' => $this->generateUrl('edit_client', ['id' => $id]),
            'method' => 'POST',
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $clientDto = $form->getData();

            $this->updateClientService->exec($clientDto);

            return $this->redirectToRoute('view_client', ['id' => $id]);
        }

        return $this->renderForm('client/edit.html.twig', [
            'form' => $form,
            'client' => $clientDto,
        ]);
    }

    /**
     * @Route("/delete-client/{id}", name="delete_client", methods={"GET"})
     */
    public function delete(string $id): Response
    {
        $this->clientRepository->remove(Uuid::fromString($id));

        return $this->redirectToRoute('landing_page');
    }

    /**
     * @Route("/add-bank-account/{id}", name="add_bank_account", methods={"POST"})
     */
    public function addBankAccount(Request $request): Response
    {
        $newBankAccountDto = new NewBankAccountDto();
        $form = $this->createForm(NewBankAccountType::class, $newBankAccountDto);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $newBankAccountDto = $form->getData();

            $id = $this->createNewClientService->exec($newBankAccountDto);

            return $this->redirectToRoute('view_client', ['id' => $id]);
        }

        return $this->redirectToRoute('landing_page');
    }
}