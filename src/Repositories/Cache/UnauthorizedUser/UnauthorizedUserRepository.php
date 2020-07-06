<?php

namespace App\Repositories\Cache\UnauthorizedUser;

use Symfony\Component\Cache\Adapter\FilesystemAdapter;

class UnauthorizedUserRepository
{
    protected $cacheUnauthorizedUser;
    protected $cacheUnauthorizedUserAdapter;

    public function __construct(string $email)
    {
        $this->cacheUnauthorizedUserAdapter = new FilesystemAdapter(
            '',
            1,
            "cacheUnauthorizedUsers"
        );
        $this->cacheUnauthorizedUser = $this->cacheUnauthorizedUserAdapter->getItem(
            'users_unauthorized_' . str_replace('@', '_', $email)
        );
    }

    /**
     * @return bool
     */
    public function getIsBlockedUser(): bool
    {
        if (!$this->cacheUnauthorizedUser->isHit()) {
            $this->cacheUnauthorizedUser->set([
                'count' => 1
            ]);
            $this->cacheUnauthorizedUserAdapter->save($this->cacheUnauthorizedUser);
        } else {
            $cacheUnauthorizedUserResponse = $this->cacheUnauthorizedUser->get();

            if ($cacheUnauthorizedUserResponse['count'] >= 3) {
                return true;
            }

            $this->cacheUnauthorizedUser->set([
                'count' => ++$cacheUnauthorizedUserResponse['count']
            ]);
            $this->cacheUnauthorizedUserAdapter->save($this->cacheUnauthorizedUser);
        }

        return false;
    }
}