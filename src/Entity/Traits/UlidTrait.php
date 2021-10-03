<?php

declare(strict_types=1);

namespace App\Entity\Traits;

use App\Exceptions\Doctrine\ObjectNotPersistedException;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UlidGenerator;
use Symfony\Component\Uid\Ulid;

trait UlidTrait
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="ulid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UlidGenerator::class)
     */
    protected ?Ulid $id = null;

    public function getIdString(): string
    {
        if ($this->id == null) {
            throw new ObjectNotPersistedException();
        }

        return $this->id->__toString();
    }

    public function getId(): Ulid
    {
        if ($this->id == null) {
            throw new ObjectNotPersistedException();
        }

        return $this->id;
    }

    public function isNewObject(): bool
    {
        return $this->id === null;
    }

    public function getIdBinary(): string
    {
        return $this->id->toBinary();
    }
}
