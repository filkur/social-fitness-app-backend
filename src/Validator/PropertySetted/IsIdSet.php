<?php

declare(strict_types=1);

namespace App\Validator\PropertySetted;

/**
 * @Annotation
 * @Target("PROPERTY")
 */
class IsIdSet extends IsPropertySet
{
    public $property = 'id';

    public bool $isULID = true;
}
