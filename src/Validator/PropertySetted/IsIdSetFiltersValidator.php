<?php

declare(strict_types=1);

namespace App\Validator\PropertySetted;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class IsIdSetFiltersValidator extends ConstraintValidator
{
    /**
     * @var EntityFinder
     */
    private $entityFinder;

    public function __construct(
        EntityFinder $entityFinder
    ) {
        $this->entityFinder = $entityFinder;
    }

    /**
     * This validator is for checking if given value is valid Entity id
     * If value is blank or empty DON'T throw the violations!!
     *
     * @param IsPropertySet $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        if (
            $this->checkIfValueIsCompleted($value)
            && ! $this->entityFinder->find($constraint->getProperty(), $value, $constraint->getTargetEntity())
        ) {
            $this->context->buildViolation($constraint->message)
                          ->setParameter('{{targetEntity}}', $constraint->getTargetEntity())
                          ->addViolation();
        }
    }

    private function checkIfValueIsCompleted($value): bool
    {
        return $value !== null && $value !== "";
    }
}
