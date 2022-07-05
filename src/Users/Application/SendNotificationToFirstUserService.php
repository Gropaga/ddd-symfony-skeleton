<?php

declare(strict_types=1);

namespace App\Users\Application;

use App\Users\Domain\Factory\UserFactory;
use App\Users\Domain\NotifierService;
use App\Users\Domain\UsersClient;

final class SendNotificationToFirstUserService
{
    private UsersClient $usersClient;
    private NotifierService $notifierService;

    public function __construct(
        UsersClient $usersClient,
        NotifierService $notifierService
    )
    {
        $this->usersClient = $usersClient;
        $this->notifierService = $notifierService;
    }

    public function exec(): void
    {
        $user = UserFactory::fromDto(
            $this->usersClient->getFirstUser()
        );

        if ($user->isNotificationNotSent()) {
            $user->sendMessages($this->notifierService);
        }
    }
}