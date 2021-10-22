<?php

declare(strict_types=1);

namespace App\DTO\Event\Output;

use Symfony\Component\Serializer\Annotation\Groups;

class EventOutput
{
    /**
     * @Groups({"event:collection", "event:item"})
     */
    public string $id;

    /**
     * @Groups({"event:collection", "event:item"})
     */
    public string $name;

    /**
     * @Groups({"event:collection", "event:item"})
     */
    public string $description;

    /**
     * @Groups({"event:collection", "event:item"})
     */
    public int $pointGoal;

    /**
     * @Groups({"event:collection", "event:item"})
     */
    public int $pointPerRep;

    /**
     * @Groups({"event:collection", "event:item"})
     */
    public int $pointPerMinute;

    /**
     * @Groups({"event:collection", "event:item"})
     */
    public string $startDate;

    /**
     * @Groups({"event:collection", "event:item"})
     */
    public string $endDate;

    /**
     * @Groups({"event:collection", "event:item"})
     */
    public string $eventType;

    /**
     * @Groups({"event:item"})
     */
    public ?array $eventMembers;
}