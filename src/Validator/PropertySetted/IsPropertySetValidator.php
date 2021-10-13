<?php

declare(strict_types=1);

namespace App\Validator\PropertySetted;

use InvalidArgumentException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\NotBlankValidator;

class IsPropertySetValidator extends NotBlankValidator
{
    private EntityFinder $entityFinder;

    public function __construct(
        EntityFinder $entityFinder
    ) {
        $this->entityFinder = $entityFinder;
    }

    /**
     * @param IsPropertySet $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        if ($constraint->isNullable() && is_null($value)) {
            return;
        }

        if ($value === null) {
            $this->context->addViolation('This Value cannot be null!');

            return;
        }

        if ($constraint->getProperty() === null) {
            throw new InvalidArgumentException("PROPERTY CANNOT BE NULL!");
        }

        if (! $constraint->nullable) {
            parent::validate($value, $constraint);
        }

        if (! is_array($value)) {
            $value = [$value];
        }

        foreach ($value as $iterator => $item) {
            if (
                $this->context->getViolations()
                              ->count() === 0
                && ! $this->entityFinder->find(
                    $constraint->getProperty(),
                    $item,
                    $constraint->getTargetEntity(),
                    $constraint->isULID()
                )
            ) {
                $this->context->buildViolation($constraint->isSetMessage)
                              ->atPath((string)$iterator)
                              ->setParameter('{{targetEntity}}', $constraint->getTargetEntity())
                              ->addViolation()
                ;
            }
        }
    }
}
