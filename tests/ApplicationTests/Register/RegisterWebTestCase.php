<?php

namespace ApplicationTests\Register;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegisterWebTestCase extends WebTestCase
{
    private KernelBrowser $client;

    public function test_register_with_correct_data()
    {
        $this->client->request(
            'POST',
            '/api/user/register',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{
                      "nickname": "testUser",
                      "email" : "testUser@user.pl",
                      "password" : "user"
                    }'
        );
        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame('201');
    }

    public function test_register_with_wrong_email()
    {
        $this->client->request(
            'POST',
            '/api/user/register',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{
                      "nickname": "test",
                      "email" : "user.pl",
                      "password" : "user"
                    }'
        );
        $this->assertResponseStatusCodeSame('422');
    }

    public function test_register_with_existing_email()
    {
        $this->client->request(
            'POST',
            '/api/user/register',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{
                      "nickname": "test",
                      "email" : "user@user.pl",
                      "password" : "user"
                    }'
        );
        $this->assertResponseStatusCodeSame('422');
    }

    public function test_register_with_existing_nickname()
    {
        $this->client->request(
            'POST',
            '/api/user/register',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{
                      "nickname": "user",
                      "email" : "test@user.pl",
                      "password" : "user"
                    }'
        );
        $this->assertResponseStatusCodeSame('422');
    }

    protected function setUp(): void
    {
        self::ensureKernelShutdown();
        $this->client = static::createClient([], [
            'HTTP_HOST' => 'localhost:8000',
        ]);
    }
}
