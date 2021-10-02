<?php

declare(strict_types=1);

namespace App\EventListener\User;

use App\DTO\User\Input\UserInput;
use App\Entity\User\User;
use App\EventListener\AbstractValidateTransformer;
use App\Service\Password\UpdatePasswordService;
use App\Utils\DataHelper\MethodHelper;
use App\Utils\ReadStorage\MutatorAfterReadStorage;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

class UserPutValidateTransformer extends AbstractValidateTransformer
{
    private UpdatePasswordService $updatePasswordService;

    public function __construct(
        MutatorAfterReadStorage $mutatorAfterReadStorage,
        ContainerInterface $container,
        UpdatePasswordService $updatePasswordService
    ) {
        parent::__construct($mutatorAfterReadStorage, $container);
        $this->updatePasswordService = $updatePasswordService;
    }
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

        return $this->updatePasswordService->update($user, $payload);
    }
}