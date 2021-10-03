<?php

declare(strict_types=1);

namespace App\Entity\Traits\Timestamp;

trait Timestamp
{
    use CreatedAt;
    use UpdatedAt;

    public function setTimestamps(): void
    {
        $this->stampCreatedAt();
        $this->stampUpdatedAt();
    }
}
