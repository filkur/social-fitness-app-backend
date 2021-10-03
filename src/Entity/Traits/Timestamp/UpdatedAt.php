<?php

declare(strict_types=1);

namespace App\Entity\Traits\Timestamp;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

trait UpdatedAt
{
    /**
     * @ORM\Column(
     *     type="datetime_immutable",
     *     options={ "default" : "CURRENT_TIMESTAMP" }
     * )
     */
    protected DateTimeImmutable $updatedAt;

    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function stampUpdatedAt(): void
    {
        $this->updatedAt = new DateTimeImmutable();
    }
}
