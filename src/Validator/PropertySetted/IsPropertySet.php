<?php

declare(strict_types=1);

namespace App\Validator\PropertySetted;

use Doctrine\Common\Annotations\Annotation\Required;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * @Annotation
 * @Target("PROPERTY")
 */
class IsPropertySet extends NotBlank
{
    public $isSetMessage = "Id obiektu {{targetEntity}} nie jest rozpoznawalne";

    /**
     * @Required()
     */
    public $targetEntity;

    /**
     * @Required()
     */
    public $property;

    public $nullable = false;

    public bool $isULID = false;

    public function __construct($options)
    {
        parent::__construct($options);
    }

    public function getTargetEntity()
    {
        return $this->targetEntity;
    }

    public function getProperty()
    {
        return $this->property;
    }

    public function isNullable(): bool
    {
        return $this->nullable;
    }

    public function isULID(): bool
    {
        return $this->isULID;
    }
}
