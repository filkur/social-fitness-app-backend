<?php

declare(strict_types=1);

namespace App\Factory\Post;

use App\Entity\Group\Group;
use App\Entity\Post\Post;
use App\Entity\User\User;

class PostFactory
{
    public static function createFromParams
    (
        User $user,
        Group $group,
        string $content
    ): Post {
        return Post::create(
            $user,
            $group,
            $content
        );
    }
}