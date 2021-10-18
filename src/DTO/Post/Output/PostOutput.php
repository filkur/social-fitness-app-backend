<?php

declare(strict_types=1);

namespace App\DTO\Post\Output;

use App\DTO\User\Output\UserOutput;

class PostOutput
{
    public string $id;

    public string $content;

    public UserOutput $createdBy;

    public string $createdAt;

    public string $updatedAt;
}