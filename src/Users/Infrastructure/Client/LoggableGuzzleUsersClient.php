<?php

declare(strict_types=1);

namespace App\Users\Infrastructure\Client;

use App\Users\Domain\Dto\UserDto;
use App\Users\Domain\UsersClient;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;

final class LoggableGuzzleUsersClient implements UsersClient
{
    private UsersClient $usersClient;
    private string $logPath;

    public function __construct(
        UsersClient $usersClient,
        string $logPath
    )
    {
        $this->usersClient = $usersClient;
        $this->logPath = $logPath;
    }

    public function getFirstUser(): UserDto
    {
        $userDto = $this->usersClient->getFirstUser();

        $this->log('Got first user by id - ' . $userDto->id);

        return $userDto;
    }

    private function log(string $string): void
    {
        $filesystem = new Filesystem();

        try {
            $filesystem->touch($this->logPath);
            $filesystem->appendToFile($this->logPath, $string);
        } catch (IOExceptionInterface $exception) {
            echo "An error occurred while writing to file at " . $exception->getPath();
        }
    }
}