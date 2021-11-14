<?php

namespace IntegrationTests;

use App\Entity\User\User;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class RepositoryTest extends KernelTestCase
{
    private EntityManager $entityManager;

    public function test_get_user_from_database()
    {
        $userRepository = $this->entityManager->getRepository(User::class);
        $user = $userRepository->findOneBy([
            'email' => 'user@user.pl'
        ]);
        self::assertEquals('user@user.pl',$user->getEmail());
    }

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
                                      ->get('doctrine')
                                      ->getManager();
    }
}
