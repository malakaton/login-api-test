<?php

declare(strict_types=1);

namespace App\Entity\User;

final class User
{
    protected $email;
    protected $password;

    public function __construct(string $email = null, string $password = null)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }
}
