<?php

declare(strict_types=1);

namespace App\Service\Register;

use ApiPlatform\Core\Validator\ValidatorInterface;
use App\Entity\User\User;
use App\Factory\User\UserFactory;
use App\Repository\User\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class RegisterService
{
    private UserRepository $userRepository;

    private EntityManagerInterface $entityManager;

    public function __construct(
        UserRepository $userRepository,
        EntityManagerInterface $entityManager
    ) {
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
    }

    public function registerUser(array $parameters)
    {
        $nickname = $parameters["nickname"];
        $email = $parameters["email"];
        $password = $parameters["password"];

        $errors = [];

        if ($this->isEmailOccupied($email)) {
            $errors[] = "Email jest zajęty ";
        }

        if ($this->isNicknameOccupied($nickname)) {
            $errors[] = "Nickname jest zajęty ";
        }

        if (count($errors) > 0) {
            return new Response(implode($errors), 422);
        }

        $user = UserFactory::createFromParams(
            $email,
            $nickname,
            $password
        );

        $this->entityManager->persist($user);

        $this->entityManager->flush();

        return new Response("Dodano użytkownika", 201);
    }

    private function isEmailOccupied(string $email): ?User
    {
        return $this->userRepository->findOneBy([
            'email' => $email,
        ]);
    }

    private function isNicknameOccupied(string $nickname): ?User
    {
        return $this->userRepository->findOneBy([
            'nickname' => $nickname,
        ]);
    }
}
