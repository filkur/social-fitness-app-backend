<?php

declare(strict_types=1);

namespace App\EventListener\GroupMember;

use App\DTO\GroupMember\Input\GroupMemberInput;
use App\Entity\Group\Group;
use App\Entity\Invitation\Invitation;
use App\Entity\User\User;
use App\EventListener\AbstractValidateTransformer;
use App\Factory\GroupMember\GroupMemberFactory;
use App\Repository\Invitation\InvitationRepository;
use App\Utils\DataHelper\MethodHelper;
use App\Utils\ReadStorage\MutatorAfterReadStorage;
use App\Utils\User\UserGetter;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GroupMemberPostValidateTransformer extends AbstractValidateTransformer
{
    private InvitationRepository $invitationRepository;

    private UserGetter $userGetter;

    public function __construct(
        MutatorAfterReadStorage $mutatorAfterReadStorage,
        ContainerInterface $container,
        InvitationRepository $invitationRepository,
        UserGetter $userGetter
    ) {
        parent::__construct($mutatorAfterReadStorage, $container);
        $this->invitationRepository = $invitationRepository;
        $this->userGetter = $userGetter;
    }

    protected function validPayload(object $payload): bool
    {
        return $payload instanceof GroupMemberInput;
    }

    protected function validRequest(Request $request): bool
    {
        return MethodHelper::isRequestPost($request);
    }

    /**
     * @param GroupMemberInput $payload
     */
    protected function transform(object $payload): object
    {
        /** @var Invitation $invitation */
        $invitation = $this->invitationRepository->findOneBy([
            'code' => $payload->code,
        ]);

        if ($invitation === null)
        {
            return new JsonResponse([
                "violations" => [
                    "message" => "Invitation not found"
                ]
            ], 404);
        }

        /** @var Group $group */
        $group = $invitation->getGroup();

        /** @var User $user */
        $user = $this->userGetter->get();

        return GroupMemberFactory::createFromParameters(
            $user,
            $group
        );
    }
}