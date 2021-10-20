<?php

declare(strict_types=1);

namespace App\DTO\Post\Output;

use App\DTO\User\Output\UserOutput;
use Symfony\Component\Serializer\Annotation\Groups;

class PostOutput
{
    /**
     * @Groups({"post:collection", "post:item"})
     */
    public string $id;

    /**
     * @Groups({"post:collection", "post:item"})
     */
    public string $content;

    /**
     * @Groups({"post:collection", "post:item"})
     */
    public UserOutput $createdBy;

    /**
     * @Groups({"post:item"})
     */
    public ?array $comments;

    /**
     * @Groups({"post:collection", "post:item"})
     */
    public string $createdAt;

    /**
     * @Groups({"post:collection", "post:item"})
     */
    public string $updatedAt;
}