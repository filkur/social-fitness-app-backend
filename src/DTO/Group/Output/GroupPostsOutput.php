<?php

declare(strict_types=1);

namespace App\DTO\Group\Output;

use App\DTO\Post\Output\PostOutput;

class GroupPostsOutput
{
    /**
     * @var PostOutput[]
     */
    public ?array $posts = [];
}