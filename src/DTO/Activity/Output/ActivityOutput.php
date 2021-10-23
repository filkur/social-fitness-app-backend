<?php

declare(strict_types=1);

namespace App\DTO\Activity\Output;

use Symfony\Component\Serializer\Annotation\Groups;

class ActivityOutput
{
    /**
     * @Groups({"activity:base"})
     */
    public string $id;

    /**
     * @Groups({"activity:base"})
     */
    public string $name;

    /**
     * @Groups({"activity:base"})
     */
    public int $value;

    /**
     * @Groups({"activity:base"})
     */
    public string $createdAt;
}