<?php

declare(strict_types=1);

namespace App\Application\Commands;

use App\Application\Dto\NewClientDto;

final class CreateClientCommand
{
    public function __construct(
        private NewClientDto $clientDto
    )
    {
    }

    public function clientDto(): NewClientDto
    {
        return $this->clientDto;
    }
}