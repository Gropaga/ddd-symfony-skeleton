<?php

declare(strict_types=1);

namespace App\Users\Infrastructure\Notifier;

use App\Users\Domain\NotificationStatusEnum;
use App\Users\Domain\NotifierService;

final class EmailNotifierService implements NotifierService
{
    public function sendNotification(
        string $message,
        string $name,
        string $email,
        string $phone
    ): NotificationStatusEnum
    {
        return NotificationStatusEnum::SENT();
    }

}