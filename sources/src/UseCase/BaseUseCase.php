<?php

declare(strict_types=1);


namespace App\UseCase;

use App\Exception\InvalidValueException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class BaseUseCase
{
    const ERROR_CODE = 'error_code';

    protected ValidatorInterface $validator;

    public function __construct(
        ValidatorInterface $validator
    )
    {
        $this->validator = $validator;
    }

    protected function validate(mixed $data, array $groups = []): void
    {
        $violations = $this->validator->validate($data, null, $groups);

        if (0 !== count($violations)) {
            foreach ($violations as $violation) {
                $field = $violation->getPropertyPath();
                $message = $violation->getMessage() . "[" . $field . "]";
                $code = (method_exists($violation, 'getConstraint')) ? ($violation->getConstraint()->payload[BaseUseCase::ERROR_CODE] ?? 0) : 0;
                throw new InvalidValueException($message, $code);
            }
        }
    }
}