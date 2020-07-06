<?php

declare(strict_types=1);

namespace App\Entity\User;

interface UserRepository
{
    public function findByEmail(string $email): User;
}
