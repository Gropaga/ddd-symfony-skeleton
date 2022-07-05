<?php

declare(strict_types=1);

namespace App\Users\Domain;

use DomainException;

final class User
{
    private NotificationStatusEnum $status;

    public function __construct(
        private int $id,
        private string $name,
        private string $surname,
        private string $email,
        private string $phone
    )
    {
        $this->status = NotificationStatusEnum::NOT_SENT();
    }

    public function sendMessages(NotifierService $notifier): void
    {
        if ($this->status->equals(NotificationStatusEnum::SENT())) {
            throw new DomainException('Notification is already sent');
        }

        $status = $notifier->sendNotification(
            'You have been notified',
            sprintf('%s %s', $this->name, $this->surname),
            $this->email,
            $this->phone
        );

        $this->status = $status;
    }

    public function isNotificationSent(): bool
    {
        return $this->status->equals(NotificationStatusEnum::SENT());
    }

    public function isNotificationNotSent(): bool
    {
        return $this->status->equals(NotificationStatusEnum::NOT_SENT());
    }

    public function isNotificationFailed(): bool
    {
        return $this->status->equals(NotificationStatusEnum::FAILED());
    }
}