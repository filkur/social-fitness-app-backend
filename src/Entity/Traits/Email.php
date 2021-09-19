<?php

declare(strict_types=1);

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait Email
{
    /**
     * @ORM\Column(
     *     type="string",
     *     unique=true,
     *     length=50
     *     )
     */
    private ?string $email;

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
}
