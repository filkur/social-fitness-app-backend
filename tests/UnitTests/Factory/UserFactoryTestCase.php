<?php

namespace UnitTests\Factory;

use App\DTO\User\Input\UserInput;
use App\Entity\User\User;
use App\Factory\User\UserFactory;
use PHPUnit\Framework\TestCase;

class UserFactoryTestCase extends TestCase
{
    public function test_create_user()
    {
        $userInput = new UserInput();
        $userInput->email = 'testuser@user.pl';
        $userInput->nickname = 'test';
        $userInput->password = 'test1234';

        $user = UserFactory::createFromParams(
            $userInput->email,
            $userInput->nickname,
            $userInput->password
        );

        $this->assertEquals($userInput->email, $user->getEmail());
        $this->assertEquals($userInput->nickname, $user->getNickname());
        $this->assertEquals($userInput->password, $user->getPassword());
    }
}
