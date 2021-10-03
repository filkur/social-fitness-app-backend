<?php

declare(strict_types=1);

namespace App\Entity\Traits\Timestamp;

interface CreatedAtInterface
{
    public function stampCreatedAt(): void;
}
