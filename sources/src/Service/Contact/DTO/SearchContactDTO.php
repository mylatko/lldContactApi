<?php

declare(strict_types=1);


namespace App\Service\Contact\DTO;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class SearchContactDTO
{
    protected string $name;

    public function __construct(
        string $name
    )
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        $metadata->addPropertyConstraints('name', [
            new NotBlank()
        ]);
    }
}