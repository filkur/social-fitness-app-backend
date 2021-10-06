<?php

declare(strict_types=1);

namespace App\Controller\Action\Register;

use App\Service\Register\RegisterService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/register", name="register")
 */
class RegisterController
{
    private RegisterService $registerService;

    public function __construct(RegisterService $registerService)
    {
        $this->registerService = $registerService;
    }

    public function __invoke(Request $request)
    {
        $parameters = json_decode($request->getContent(), true);

        if (! $this->checkParametersAmount($parameters)) {
            return new Response("Musisz podać 3 parametry: nickname, email, password", 400);
        }

        return $this->registerService->registerUser($parameters);
    }

    private function checkParametersAmount(array $parameters): bool
    {
        if (count($parameters) != 3) {
            return false;
        }

        return true;
    }
}