<?php

namespace App\Repositories\User;

use App\Entity\User\User;
use App\Entity\User\UserRepository as IUserRepository;

class UserRepository implements IUserRepository
{
    protected $users = [
        [
            'email' => 'user1@test.com',
            'password' => '123456'
        ],
        [
            'email' => 'user11@test.com',
            'password' => '123452'
        ],
        [
            'email' => 'use3@test.com',
            'password' => 'fake'
        ]
    ];

    /**
     * @param string $email
     * @return User
     */
    public function findByEmail(string $email): User
    {
        $userIdx = array_search($email, array_column($this->users, 'email'), true);

        if (is_numeric($userIdx)) {
            return (new User($this->users[$userIdx]['email'], $this->users[$userIdx]['password']));
        }

        return (new User());
    }

}