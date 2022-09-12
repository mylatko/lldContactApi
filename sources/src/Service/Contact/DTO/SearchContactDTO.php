<?php

declare(strict_types=1);


namespace App\Service\Contact\DTO;

use App\Error;
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
            new NotBlank(['payload' => ['error_code' => Error::SEARCH_CONTACT_NAME_NOT_BLANK_CODE]])
        ]);
    }
}