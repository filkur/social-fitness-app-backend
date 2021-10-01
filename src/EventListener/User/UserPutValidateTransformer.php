<?php

declare(strict_types=1);

namespace App\EventListener\User;

use App\DTO\User\Input\UserInput;
use App\Entity\User\User;
use App\EventListener\AbstractValidateTransformer;
use App\Utils\DataHelper\MethodHelper;
use Symfony\Component\HttpFoundation\Request;

class UserPutValidateTransformer extends AbstractValidateTransformer
{
    protected function validPayload(object $payload): bool
    {
        return $payload instanceof UserInput;
    }

    protected function validRequest(Request $request): bool
    {
        return MethodHelper::isRequestPut($request);
    }

    /**
     * @param UserInput $payload
     */
    protected function transform(object $payload): object
    {
        /** @var User $user */
        $user = $this->mutatorAfterReadStorage->getObject();

        $user->update(
            $payload->nickname,
            $payload->email
        );

        return $user;
    }
}