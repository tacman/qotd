<?php

namespace App\Entity;

use Symfony\Component\Security\Core\User\UserInterface;

final readonly class User implements UserInterface
{
    public function __construct(private string $identifier)
    {
    }

    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function eraseCredentials(): void
    {
        // Nothing to do
    }

    public function getUserIdentifier(): string
    {
        return $this->identifier;
    }
}