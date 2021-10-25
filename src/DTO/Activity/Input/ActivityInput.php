<?php

declare(strict_types=1);

namespace App\DTO\Activity\Input;

use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Activity\ActivityDate as EndDateValidator;

/**
 * @EndDateValidator()
 */
class ActivityInput
{
    /**
     * @Assert\NotBlank()
     * @Assert\Type(
     *     type="string"
     * )
     */
    public string $eventId;

    /**
     * @Assert\NotBlank()
     * @Assert\Type(
     *     type="string"
     * )
     * @Assert\Length(
     *     max=40
     * )
     */
    public string $name;

    /**
     * @Assert\Type(
     *     type="integer"
     * )
     * @Assert\GreaterThan(
     *     groups={"event:create", "event:update"},
     *     value="-1"
     * )
     */
    public int $value;
}