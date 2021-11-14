<?php

namespace ApplicationTests\Login;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginWebTestCase extends WebTestCase
{
    private KernelBrowser $client;

    public function test_login_user_correct_credentials()
    {
        $this->client->request(
            'POST',
            '/api/login',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{
                      "email" : "user@user.pl",
                      "password" : "test1234"
                }'
        );
        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame('200');
    }

    public function test_login_user_incorrect_credentials()
    {
        $this->client->request(
            'POST',
            '/api/login',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{
                      "email" : "anonim@user.pl",
                      "password" : "1234"
                }'
        );
        $this->assertResponseStatusCodeSame('401',"Invalid Credentials");
    }

    protected function setUp(): void
    {
        self::ensureKernelShutdown();
        $this->client = static::createClient([], [
            'HTTP_HOST' => 'localhost:8000',
        ]);
    }
}
