<?php

declare(strict_types=1);

namespace App\Validator\PropertySetted;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 * @Target("PROPERTY")
 */
class IsIdSetFilters extends Constraint
{
    public $message = "Id obiektu {{targetEntity}} nie jest rozpoznawalne";

    /**
     * @Required()
     */
    public $targetEntity;

    public $property = 'id';

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
}
