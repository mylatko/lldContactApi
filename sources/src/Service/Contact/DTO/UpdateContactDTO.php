<?php

declare(strict_types=1);


namespace App\Service\Contact\DTO;

use Symfony\Component\Validator\Mapping\ClassMetadata;

class UpdateContactDTO extends SaveContactDTO
{
    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {

    }
}