<?php

declare(strict_types=1);

namespace App\Users\Infrastructure\Notifier;

use App\Users\Domain\NotificationStatusEnum;
use App\Users\Domain\NotifierService;

final class BaseNotifierService implements NotifierService
{
    private array $notifierServices;

    public function __construct(NotifierService ...$notifierServices)
    {
        $this->notifierServices = $notifierServices;
    }

    public function sendNotification(string $subject, string $name, string $email, string $phone): NotificationStatusEnum
    {
        foreach ($this->notifierServices as $notifierService) {
            $notifierService->sendNotification(
                $subject,
                $name,
                $email,
                $phone
            );
        }

        return NotificationStatusEnum::SENT();
    }
}