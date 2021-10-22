<?php

declare(strict_types=1);

namespace App\DTO\User\Output;

use App\Entity\User\User;
use App\Utils\Date\DateHelper;
use Symfony\Component\Serializer\Annotation\Groups;

class UserOutput
{
    /**
     * @Groups({"user:base"})
     */
    public ?string $id;

    /**
     * @Groups({"user:base"})
     */
    public ?string $nickname;

    /**
     * @Groups({"user:base"})
     */
    public ?string $email;

    /**
     * @Groups({"user:base"})
     */
    public ?string $createdAt = null;

    /**
     * @Groups({"user:base"})
     */
    public ?string $updatedAt = null;

    public static function createFromUser(
        User $user
    ): self {
        $output = new self();

        $output->id = $user->getIdString();
        $output->nickname = $user->getNickname();
        $output->email = $user->getEmail();

        $output->createdAt = DateHelper::toDateTimeFormat(
            $user->getCreatedAt()
        );
        $output->updatedAt = DateHelper::toDateTimeFormat(
            $user->getUpdatedAt()
        );

        return $output;
    }
}