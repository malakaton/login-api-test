<?php


declare(strict_types=1);

namespace App\Service;

use App\Repositories\Cache\UnauthorizedUser\UnauthorizedUserRepository;
use App\Repositories\User\UserRepository;
use Symfony\Component\HttpFoundation\Response;

final class Login
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param string $email
     * @param string $password
     * @return int
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function __invoke(string $email, string $password): int
    {
        $userModel = $this->userRepository->findByEmail($email);

        if (!is_null($userModel->getEmail())) {
            if ($userModel->getPassword() === $password) {
                return Response::HTTP_OK;
            }

            if ($userModel->getPassword() !== $password) {
                if ((new UnauthorizedUserRepository($userModel->getEmail()))->getIsBlockedUser()) {
                    return Response::HTTP_FORBIDDEN;
                }

                return Response::HTTP_UNAUTHORIZED;
            }
        }

        return Response::HTTP_NOT_FOUND;
    }
}
