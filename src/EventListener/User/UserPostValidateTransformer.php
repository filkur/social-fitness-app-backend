<?php

declare(strict_types=1);

namespace App\EventListener\User;

use App\DTO\User\Input\UserInput;
use App\EventListener\AbstractValidateTransformer;
use App\Factory\User\UserFactory;
use App\Utils\DataHelper\MethodHelper;
use Symfony\Component\HttpFoundation\Request;

class UserPostValidateTransformer extends AbstractValidateTransformer
{
    protected function validPayload(object $payload): bool
    {
        return $payload instanceof UserInput;
    }

    protected function validRequest(Request $request): bool
    {
        return MethodHelper::isRequestPost($request);
    }

    /**
     * @param UserInput $payload
     */
    protected function transform(object $payload): object
    {
        return UserFactory::createFromUserInput($payload);
    }
}