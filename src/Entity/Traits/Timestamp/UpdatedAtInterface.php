<?php

declare(strict_types=1);

namespace App\Entity\Traits\Timestamp;

interface UpdatedAtInterface
{
    public function stampUpdatedAt(): void;
}
