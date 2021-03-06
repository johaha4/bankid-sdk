<?php

declare(strict_types=1);

namespace BankID\SDK\Exceptions;

use Exception;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * Class ValidationException
 *
 * @package BankID\SDK\Exceptions
 */
class ValidationException extends Exception
{

    /**
     * @var ConstraintViolationListInterface
     */
    protected $errors;

    /**
     * ValidationException constructor.
     *
     * @param ConstraintViolationListInterface $errors
     */
    public function __construct(ConstraintViolationListInterface $errors)
    {
        $this->errors = $errors;

        $message = \sprintf(
            'A property validation error occurred. %s (%s)',
            $errors->get(0)->getMessage(),
            $errors->get(0)->getPropertyPath()
        );

        parent::__construct($message);
    }

    /**
     * Returns the list of errors.
     *
     * @return ConstraintViolationListInterface
     */
    public function getErrors(): ConstraintViolationListInterface
    {
        return $this->errors;
    }
}
