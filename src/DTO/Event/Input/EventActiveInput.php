<?php

declare(strict_types=1);

namespace App\DTO\Event\Input;

use Symfony\Component\Validator\Constraints as Assert;

class EventActiveInput
{
    /**
     * @Assert\Type(
     *     type="string"
     * )
     * @Assert\NotBlank()
     */
    public ?string $id = null;

    /**
     * @Assert\Type(
     *     type="bool"
     * )
     */
    public bool $isActive = false;
}