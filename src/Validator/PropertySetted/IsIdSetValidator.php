<?php

declare(strict_types=1);

namespace App\Validator\PropertySetted;

class IsIdSetValidator extends IsPropertySetValidator
{
    public function __construct(EntityFinder $entityFinder)
    {
        parent::__construct($entityFinder);
    }
}
