<?php

namespace App\Entity\Event;

use App\Entity\Activity\Activity;
use App\Entity\Group\Group;
use App\Entity\Traits\Timestamp\Timestamp;
use App\Entity\Traits\Timestamp\TimestampInterface;
use App\Entity\Traits\UlidTrait;
use App\Repository\Event\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EventRepository::class)
 */
class Event implements TimestampInterface
{
    use UlidTrait;
    use Timestamp;

    private const EVENT_TYPE_ALL       = 'ALL';
    private const EVENT_TYPE_REP       = 'REP';
    private const EVENT_TYPE_TIME      = 'TIME';
    private const EVENT_TYPE_LESS_TIME = 'LESS_TIME';

    /**
     * @ORM\Column(
     *     type="string",
     *      length=50
     * )
     */
    private string $name;

    /**
     * @ORM\Column(
     *     type="string",
     *     length=200
     * )
     */
    private string $description;

    /**
     * @ORM\Column(
     *     type="integer",
     *     nullable=true,
     *     name="point_goal"
     * )
     */
    private int $pointGoal = 0;

    /**
     * @ORM\Column(
     *     type="integer",
     *     nullable=true,
     *     name="points_per_minute"
     * )
     */
    private int $pointsPerMinute = 0;

    /**
     * @ORM\Column(
     *     type="integer",
     *     nullable=true,
     *     name="points_per_rep"
     * )
     */
    private int $pointsPerRep = 0;

    /**
     * @ORM\Column(
     *     type="boolean",
     *     name="is_active"
     * )
     */
    private bool $isActive = true;

    /**
     * @ORM\Column(
     *     type="string",
     *     name="event_type"
     * )
     */
    public string $eventType;

    /**
     * @ORM\ManyToOne(
     *     targetEntity=Group::class,
     *     inversedBy="events"
     * )
     * @ORM\JoinColumn(nullable=false)
     */
    private Group $group;

    /**
     * @ORM\OneToMany(
     *     targetEntity=Activity::class,
     *     mappedBy="event",
     *     orphanRemoval=true,
     *     cascade={"persist", "remove"}
     * )
     */
    private Collection $activities;

    public function __construct()
    {
        $this->activities = new ArrayCollection();
    }

    public function getEventType(): string
    {
        return $this->eventType;
    }

    public function setEventType(string $eventType): void
    {
        switch ($eventType) {
            case self::EVENT_TYPE_ALL:
            {
                $this->eventType = self::EVENT_TYPE_ALL;

                return;
            }
            case self::EVENT_TYPE_REP:
            {
                $this->eventType = self::EVENT_TYPE_REP;

                return;
            }
            case self::EVENT_TYPE_TIME:
            {
                $this->eventType = self::EVENT_TYPE_TIME;

                return;
            }
            case self::EVENT_TYPE_LESS_TIME:
            {
                $this->eventType = self::EVENT_TYPE_LESS_TIME;

                return;
            }
        }
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPointGoal(): ?int
    {
        return $this->pointGoal;
    }

    public function setPointGoal(?int $pointGoal): self
    {
        $this->pointGoal = $pointGoal;

        return $this;
    }

    public function getPointsPerMinute(): ?int
    {
        return $this->pointsPerMinute;
    }

    public function setPointsPerMinute(?int $pointsPerMinute): self
    {
        $this->pointsPerMinute = $pointsPerMinute;

        return $this;
    }

    public function getPointsPerRep(): ?int
    {
        return $this->pointsPerRep;
    }

    public function setPointsPerRep(?int $pointsPerRep): self
    {
        $this->pointsPerRep = $pointsPerRep;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getGroup(): Group
    {
        return $this->group;
    }

    public function setGroup(Group $group): void
    {
        $this->group = $group;
    }

    /**
     * @return Collection|Activity[]
     */
    public function getActivities(): Collection
    {
        return $this->activities;
    }

    public function addActivity(Activity $activity): self
    {
        if (!$this->activities->contains($activity)) {
            $this->activities[] = $activity;
            $activity->setEvent($this);
        }

        return $this;
    }

    public function removeActivity(Activity $activity): self
    {
        if ($this->activities->removeElement($activity)) {
            // set the owning side to null (unless already changed)
            if ($activity->getEvent() === $this) {
                $activity->setEvent(null);
            }
        }

        return $this;
    }
}
