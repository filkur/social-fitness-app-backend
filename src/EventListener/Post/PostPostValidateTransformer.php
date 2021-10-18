<?php

declare(strict_types=1);

namespace App\EventListener\Post;

use App\DTO\Post\Input\PostInput;
use App\Entity\Group\Group;
use App\Entity\User\User;
use App\EventListener\AbstractValidateTransformer;
use App\Factory\Post\PostFactory;
use App\Repository\Group\GroupRepository;
use App\Utils\DataHelper\MethodHelper;
use App\Utils\ReadStorage\MutatorAfterReadStorage;
use App\Utils\User\UserGetter;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

class PostPostValidateTransformer extends AbstractValidateTransformer
{
    private UserGetter $userGetter;

    private GroupRepository $groupRepository;

    public function __construct(
        MutatorAfterReadStorage $mutatorAfterReadStorage,
        ContainerInterface $container,
        UserGetter $userGetter,
        GroupRepository $groupRepository
    ) {
        parent::__construct($mutatorAfterReadStorage, $container);
        $this->userGetter = $userGetter;
        $this->groupRepository = $groupRepository;
    }

    protected function validPayload(object $payload): bool
    {
        return $payload instanceof PostInput;
    }

    protected function validRequest(Request $request): bool
    {
        return MethodHelper::isRequestPost($request);
    }

    /**
     * @param PostInput $payload
     */
    protected function transform(object $payload): object
    {
        /** @var User $user */
        $user = $this->userGetter->get();

        /** @var Group $group */
        $group = $this->groupRepository->find($payload->groupId);

        return PostFactory::createFromParams(
            $user,
            $group,
            $payload->content
        );
    }
}