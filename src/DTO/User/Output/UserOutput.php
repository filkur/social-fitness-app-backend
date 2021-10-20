<?php

declare(strict_types=1);

namespace App\DTO\User\Output;

use App\Entity\User\User;
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

    public static function createFromUser(
        User $user
    ): self {
        $output = new self();

        $output->id = $user->getIdString();
        $output->nickname = $user->getNickname();
        $output->email = $user->getEmail();

        return $output;
    }
}