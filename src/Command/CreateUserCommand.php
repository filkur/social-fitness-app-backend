<?php

declare(strict_types=1);

namespace App\Command;

use App\Factory\User\UserFactory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateUserCommand extends Command
{
    protected static $defaultName = "app:create-user";

    public const USER_EMAIL = 'user@user.pl';
    public const USER_NICKNAME = 'user';
    public const USER_PASSWORD = 'test1234';

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

        parent::__construct();

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $user = UserFactory::createFromParams(
            self::USER_EMAIL,
            self::USER_NICKNAME,
            self::USER_PASSWORD
        );

        $this->entityManager->persist($user);

        $this->entityManager->flush();

        return 0;
    }
}