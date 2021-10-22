<?php

declare(strict_types=1);

namespace App\Factory\Comment;

use App\Entity\Comment\Comment;
use App\Entity\Post\Post;
use App\Entity\User\User;

class CommentFactory
{
    public static function createFromParams(
        User $user,
        Post $post,
        string $content
    ): Comment {
        return Comment::create(
            $user,
            $post,
            $content
        );
    }
}