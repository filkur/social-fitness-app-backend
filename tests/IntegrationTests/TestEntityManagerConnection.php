<?php

namespace IntegrationTests;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TestEntityManagerConnection extends KernelTestCase
{
    private EntityManager $entityManager;

    public function test_connection_to_db()
    {
        $this->entityManager->getConnection()
                            ->connect()
        ;

        $isConnected = $this->entityManager->getConnection()
                                           ->isConnected();

        $this->assertEquals(true, $isConnected);

        $this->entityManager->getConnection()
                            ->close()
        ;

        $isConnected = $this->entityManager->getConnection()
                                           ->isConnected();

        $this->assertEquals(false, $isConnected);
    }

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
                                      ->get('doctrine')
                                      ->getManager();
    }
}
