<?php

declare(strict_types=1);

namespace App\EventListener\Group;

use App\DTO\Group\Input\GroupInput;
use App\Entity\Group\Group;
use App\EventListener\AbstractValidateTransformer;
use App\Utils\DataHelper\MethodHelper;
use Symfony\Component\HttpFoundation\Request;

class GroupPatchValidateTransformer extends AbstractValidateTransformer
{
    protected function validPayload(object $payload): bool
    {
        return $payload instanceof GroupInput;
    }

    protected function validRequest(Request $request): bool
    {
        return MethodHelper::isRequestPatch($request);
    }

    /**
     * @param GroupInput $payload
     */
    protected function transform(object $payload): object
    {
        /** @var Group $group */
        $group = $this->mutatorAfterReadStorage->getObject();

        $group->setName($payload->name);
        $group->setDescription($payload->description);

        return $group;
    }
}