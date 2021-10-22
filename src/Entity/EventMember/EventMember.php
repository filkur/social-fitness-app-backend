<?php

namespace App\Entity\EventMember;

use App\Entity\Activity\Activity;
use App\Entity\Event\Event;
use App\Entity\Traits\Timestamp\Timestamp;
use App\Entity\Traits\Timestamp\TimestampInterface;
use App\Entity\Traits\UlidTrait;
use App\Entity\User\User;
use App\Repository\EventMember\EventMemberRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(
 *     repositoryClass=EventMemberRepository::class
 * )
 * @ORM\Table(
 *     name="event_member"
 * )
 */
class EventMember implements TimestampInterface
{
    use UlidTrait;
    use Timestamp;

    /**
     * @ORM\ManyToOne(
     *     targetEntity=User::class,
     *     inversedBy="eventMembers"
     * )
     */
    public User $user;

    /**
     * @ORM\OneToMany(
     *     targetEntity=Activity::class,
     *     mappedBy="eventMember",
     *     orphanRemoval=true,
     *     cascade={"persist", "remove"}
     * )
     */
    private Collection $activities;

    /**
     * @ORM\ManyToOne(
     *     targetEntity=Event::class,
     *     inversedBy="eventMembers"
     * )
     * @ORM\JoinColumn(
     *     nullable=false
     * )
     */
    private Event $event;

    public function __construct()
    {
        $this->activities = new ArrayCollection();
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function getActivities(): Collection
    {
        return $this->activities;
    }

    public function addActivity(Activity $activity): self
    {
        if (! $this->activities->contains($activity)) {
            $this->activities[] = $activity;
            $activity->setEventMember($this);
        }

        return $this;
    }

    public function removeActivity(Activity $activity): self
    {
        if ($this->activities->removeElement($activity)) {
            // set the owning side to null (unless already changed)
            if ($activity->getEventMember() === $this) {
                $activity->setEventMember(null);
            }
        }

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
}
