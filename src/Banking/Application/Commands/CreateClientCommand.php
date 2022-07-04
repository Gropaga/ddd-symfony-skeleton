<?php

declare(strict_types=1);

namespace App\Banking\Application\Commands;

use App\Banking\Application\Dto\NewClientDto;

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