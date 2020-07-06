<?php


declare(strict_types=1);

namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class LoginControllerTest extends WebTestCase
{

    /**
     *
     */
    private static $client;

    public function setUp(): void
    {
        copy(__DIR__ . '/../data/users.orig.csv',__DIR__ . '/../data/users.csv');
        if (null === self::$client) {
            self::$client = static::createClient();
        }
    }

    public function testLoginSuccessfully(): void
    {
        self::$client->request('POST', '/login',[
            'email' => 'user1@test.com',
            'password' => '123456'
        ]);

        $this->assertEquals(200, self::$client->getResponse()->getStatusCode());
    }

    public function testLoginFailed(): void
    {
        self::$client->request('POST', '/login',[
            'email' => 'user1@test.com',
            'password' => '654321'
        ]);

        $this->assertEquals(401, self::$client->getResponse()->getStatusCode());
    }

    public function testUserNotFound(): void
    {
        self::$client->request('POST', '/login',[
            'email' => 'user2@test.com',
            'password' => '123456'
        ]);

        $this->assertEquals(404, self::$client->getResponse()->getStatusCode());
    }

    public function testUserBlocked(): void
    {
        self::$client->request('POST', '/login',[
            'email' => 'use3@test.com',
            'password' => '123456'
        ]);
        $this->assertEquals(401, self::$client->getResponse()->getStatusCode());

        self::$client->request('POST', '/login',[
            'email' => 'use3@test.com',
            'password' => '123456'
        ]);
        $this->assertEquals(401, self::$client->getResponse()->getStatusCode());

        self::$client->request('POST', '/login',[
            'email' => 'use3@test.com',
            'password' => '123456'
        ]);
        $this->assertEquals(401, self::$client->getResponse()->getStatusCode());

        self::$client->request('POST', '/login',[
            'email' => 'use3@test.com',
            'password' => '123456'
        ]);
        $this->assertEquals(403, self::$client->getResponse()->getStatusCode());

    }

    public function tearDown(): void
    {
        unlink(__DIR__ . '/../data/users.csv');
    }
}
