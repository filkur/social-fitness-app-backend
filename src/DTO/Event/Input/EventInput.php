<?php

declare(strict_types=1);

namespace App\DTO\Event\Input;

use App\Entity\Event\Event;
use App\Utils\Date\DateHelper;
use App\Validator\PropertySetted\IsIdSet;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Group\Group;

class EventInput
{
    /**
     * @Groups({"event:patch"})
     * @Assert\NotBlank(
     *     groups={"event:update"}
     * )
     * @Assert\Type(
     *     groups={"event:update"},
     *     type="string"
     * )
     */
    public string $id;

    /**
     * @Groups({"event:post"})
     * @IsIdSet(
     *     groups={"event:create"},
     *     targetEntity=Group::class
     * )
     */
    public string $groupId;

    /**
     * @Groups({"event:post", "event:patch"})
     * @Assert\NotBlank(
     *     groups={"event:create", "event:update"}
     * )
     * @Assert\Type(
     *     groups={"event:create", "event:update"},
     *     type="string"
     * )
     * @Assert\Length(
     *     groups={"event:create", "event:update"},
     *     max=40
     * )
     */
    public string $name;

    /**
     * @Groups({"event:post", "event:patch"})
     * @Assert\NotBlank(
     *     groups={"event:create", "event:update"}
     * )
     * @Assert\Type(
     *     groups={"event:create", "event:update"},
     *     type="string"
     * )
     * @Assert\Length(
     *     groups={"event:create", "event:update"},
     *     max=200
     * )
     */
    public string $description;

    /**
     * @Groups({"event:post", "event:patch"})
     * @Assert\Type(
     *     groups={"event:create", "event:update"},
     *     type="integer"
     * )
     * @Assert\GreaterThan(
     *     groups={"event:create", "event:update"},
     *     value="-1"
     * )
     */
    public int $pointGoal = 0;

    /**
     * @Groups({"event:post", "event:patch"})
     * @Assert\Type(
     *     groups={"event:create", "event:update"},
     *     type="integer"
     * )
     * @Assert\GreaterThan(
     *     groups={"event:create", "event:update"},
     *     value="-1"
     * )
     */
    public int $pointPerRep = 0;

    /**
     * @Groups({"event:post", "event:patch"})
     * @Assert\Type(
     *     groups={"event:create", "event:update"},
     *     type="integer"
     * )
     * @Assert\GreaterThan(
     *     groups={"event:create", "event:update"},
     *     value="-1",
     * )
     */
    public int $pointPerMinute = 0;

    /**
     * @Groups({"event:post", "event:patch"})
     * @Assert\NotBlank(
     *     groups={"event:create", "event:update"}
     * )
     * @Assert\Type(
     *     groups={"event:create", "event:update"},
     *     type="string"
     * )
     */
    public string $startDate;

    /**
     * @Groups({"event:post", "event:patch"})
     * @Assert\NotBlank(
     *     groups={"event:create", "event:update"}
     * )
     * @Assert\Type(
     *     groups={"event:create", "event:update"},
     *     type="string"
     * )
     */
    public string $endDate;

    /**
     * @Groups({"event:post", "event:patch"})
     * @Assert\NotBlank(
     *     groups={"event:create", "event:update"}
     * )
     * @Assert\Type(
     *     groups={"event:create", "event:update"},
     *     type="string"
     * )
     */
    public string $eventType;

    public static function createFromEntity(Event $object)
    {
        $self = new self();

        $self->id = $object->getIdString();
        $self->groupId = $object->getGroup()
                                ->getIdString();
        $self->name = $object->getName();
        $self->description = $object->getDescription();
        $self->pointGoal = $object->getPointGoal();
        $self->pointPerRep = $object->getPointsPerRep();
        $self->pointPerMinute = $object->getPointsPerRep();
        $self->startDate = DateHelper::toDateFormat(
            $object->getStartDate()
        );
        $self->endDate = DateHelper::toDateFormat(
            $object->getEndDate()
        );
        $self->eventType = $object->getEventType();

        return $self;
    }
}