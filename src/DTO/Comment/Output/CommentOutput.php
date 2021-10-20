<?php

declare(strict_types=1);

namespace App\DTO\Comment\Output;

use App\DTO\User\Output\UserOutput;
use Symfony\Component\Serializer\Annotation\Groups;

class CommentOutput
{
    /**
     * @Groups({"comment:base"})
     */
    public string $id;

    /**
     * @Groups({"comment:base"})
     */
    public UserOutput $createdBy;

    /**
     * @Groups({"comment:base"})
     */
    public string $content;
}