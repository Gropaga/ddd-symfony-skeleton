<?php

declare(strict_types=1);

namespace App\Users\Domain;

use MyCLabs\Enum\Enum;

/**
 * @method static NotificationStatusEnum SENT()
 * @method static NotificationStatusEnum NOT_SENT()
 * @method static NotificationStatusEnum FAILED()
 */
final class NotificationStatusEnum extends Enum
{
    private const SENT = 'SENT';
    private const NOT_SENT = 'NOT_SENT';
    private const FAILED = 'FAILED';
}