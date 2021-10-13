<?php

declare(strict_types=1);

namespace App\EventListener\Group;

use App\DTO\Group\Input\GroupInput;
use App\Entity\User\User;
use App\EventListener\AbstractValidateTransformer;
use App\Factory\Group\GroupFactory;
use App\Utils\DataHelper\MethodHelper;
use App\Utils\ReadStorage\MutatorAfterReadStorage;
use App\Utils\User\UserGetter;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

class GroupPostValidateTransformer extends AbstractValidateTransformer
{
    private UserGetter $userGetter;

    public function __construct(
        MutatorAfterReadStorage $mutatorAfterReadStorage,
        ContainerInterface $container,
        UserGetter $userGetter
    ) {
        parent::__construct($mutatorAfterReadStorage, $container);
        $this->userGetter = $userGetter;
    }

    protected function validPayload(object $payload): bool
    {
        return $payload instanceof GroupInput;
    }

    protected function validRequest(Request $request): bool
    {
        return MethodHelper::isRequestPost($request);
    }

    /**
     * @param GroupInput $payload
     */
    protected function transform(object $payload): object
    {
        /** @var User $owner */
        $owner = $this->userGetter->get();
        $name = $payload->name;
        $description = $payload->description;

        return GroupFactory::createFromParams(
            $owner,
            $name,
            $description
        );
    }
}