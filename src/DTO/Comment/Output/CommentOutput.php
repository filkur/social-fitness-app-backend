<?php

declare(strict_types=1);

namespace App\DTO\Comment\Output;

use App\DTO\User\Output\UserOutput;

class CommentOutput
{
    public string $id;

    public UserOutput $createdBy;

    public string $content;
}