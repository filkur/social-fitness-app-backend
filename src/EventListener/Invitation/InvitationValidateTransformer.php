<?php

declare(strict_types=1);

namespace App\EventListener\Invitation;

use App\DTO\Invitation\Input\InvitationInput;
use App\EventListener\AbstractValidateTransformer;
use App\Service\Invitation\CreateInvitationService;
use App\Utils\DataHelper\MethodHelper;
use App\Utils\ReadStorage\MutatorAfterReadStorage;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

class InvitationValidateTransformer extends AbstractValidateTransformer
{
    private CreateInvitationService $createInvitationService;

    public function __construct(
        MutatorAfterReadStorage $mutatorAfterReadStorage,
        ContainerInterface $container,
        CreateInvitationService $createInvitationService
    ) {
        parent::__construct($mutatorAfterReadStorage, $container);
        $this->createInvitationService = $createInvitationService;
    }

    protected function validPayload(object $payload): bool
    {
        return $payload instanceof InvitationInput;
    }

    protected function validRequest(Request $request): bool
    {
        return MethodHelper::isRequestPost($request);
    }

    /**
     * @param InvitationInput $payload
     */
    protected function transform(object $payload): object
    {
        return $this->createInvitationService->create($payload);
    }
}