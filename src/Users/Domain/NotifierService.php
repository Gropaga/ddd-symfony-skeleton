<?php

declare(strict_types=1);

namespace App\Users\Domain;

interface NotifierService
{
    public function sendNotification(
        string $subject,
        string $name,
        string $email,
        string $phone
    ): NotificationStatusEnum;
}