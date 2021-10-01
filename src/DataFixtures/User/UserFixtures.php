<?php

declare(strict_types=1);

namespace App\DataFixtures\User;

use App\Factory\User\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public const USER_EMAIL = 'user@user.pl';
    public const USER_NICKNAME = 'user';
    public const USER_PASSWORD = 'test1234';

    public function load(ObjectManager $manager)
    {
        $user = UserFactory::createFromParams(
            self::USER_EMAIL,
            self::USER_NICKNAME,
            self::USER_PASSWORD
        );

        $manager->persist($user);

        $manager->flush();
    }
}