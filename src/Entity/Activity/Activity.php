<?php

namespace App\Entity\Activity;

use App\Entity\EventMember\EventMember;
use App\Entity\Event\Event;
use App\Entity\Traits\Timestamp\Timestamp;
use App\Entity\Traits\Timestamp\TimestampInterface;
use App\Entity\Traits\UlidTrait;
use App\Repository\Activity\ActivityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ActivityRepository::class)
 */
class Activity implements TimestampInterface
{
    use UlidTrait;
    use Timestamp;

    /**
     * @ORM\Column(
     *     type="integer",
     *     nullable=false
     * )
     */
    private int $value;

    /**
     * @ORM\Column(
     *     type="string",
     *     nullable=false
     * )
     */
    private string $name;

    /**
     * @ORM\ManyToOne(
     *     targetEntity=EventMember::class,
     *     inversedBy="activities"
     * )
     * @ORM\JoinColumn(
     *     nullable=false
     * )
     */
    private EventMember $eventMember;

    /**
     * @ORM\ManyToOne(
     *     targetEntity=Event::class,
     *     inversedBy="activities"
     * )
     * @ORM\JoinColumn(
     *     nullable=false
     * )
     */
    private Event $event;

    public static function create(
        string $name,
        int $value,
        EventMember $eventMember,
        Event $event
    ): self {
        $self = new self();

        $self->setName($name);
        $self->setValue($value);
        $self->setEventMember($eventMember);
        $self->setEvent($event);

        $eventMember->addActivity($self);
        $event->addActivity($self);

        return $self;
    }

    public function getEventMember(): ?EventMember
    {
        return $this->eventMember;
    }

    public function setEventMember(?EventMember $eventMember): self
    {
        $this->eventMember = $eventMember;

        return $this;
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): self
    {
        $this->event = $event;

        return $this;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function setValue(int $value): void
    {
        $this->value = $value;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
