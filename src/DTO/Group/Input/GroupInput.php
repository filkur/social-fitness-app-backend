<?php

declare(strict_types=1);

namespace App\DTO\Group\Input;

use Symfony\Component\Validator\Constraints as Assert;

class GroupInput
{
    /**
     * @Assert\NotBlank()
     * @Assert\Length(
     *     max=50
     * )
     * @Assert\Type(
     *     type="string"
     * )
     */
    public ?string $name = null;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(
     *     max=50
     * )
     * @Assert\Type(
     *     type="string"
     * )
     */
    public ?string $description = null;
}