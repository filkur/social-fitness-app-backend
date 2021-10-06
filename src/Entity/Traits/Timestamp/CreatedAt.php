<?php

declare(strict_types=1);

namespace App\Entity\Traits\Timestamp;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

trait CreatedAt
{
    /**
     * @ORM\Column(
     *     type="datetime_immutable",
     *     options={ "default" : "CURRENT_TIMESTAMP" },
     *     name="created_at"
     * )
     */
    protected DateTimeImmutable $createdAt;

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function stampCreatedAt(): void
    {
        $this->createdAt = new DateTimeImmutable();
    }
}
