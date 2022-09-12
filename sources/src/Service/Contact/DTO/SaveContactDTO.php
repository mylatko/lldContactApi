<?php

declare(strict_types=1);


namespace App\Service\Contact\DTO;

use App\Error;
use App\Service\Picture\PictureService;
use App\UseCase\BaseUseCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class SaveContactDTO
{
    protected string $firstName;
    protected string $lastName;
    protected string $address;
    protected string $phone;
    protected string $birthday;
    protected string $email;
    protected ?UploadedFile $picture;

    public function __construct(
        string $firstName,
        string $lastName,
        string $address,
        string $phone,
        string $birthday,
        string $email,
        ?UploadedFile $picture
    )
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->address = $address;
        $this->phone = $phone;
        $this->birthday = $birthday;
        $this->email = $email;
        $this->picture = $picture;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getBirthday(): string
    {
        return $this->birthday;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPicture():? UploadedFile
    {
        return $this->picture;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        $metadata->addPropertyConstraints('firstName', [
            new NotBlank(['payload' => ['error_code' => Error::SAVE_CONTACT_FIRST_NAME_NOT_BLANK_CODE]])
        ]);

        $metadata->addPropertyConstraints('lastName', [
            new NotBlank(['payload' => [BaseUseCase::ERROR_CODE => Error::SAVE_CONTACT_LAST_NAME_NOT_BLANK_CODE]])
        ]);

        $metadata->addPropertyConstraints('address', [
            new NotBlank(['payload' => [BaseUseCase::ERROR_CODE => Error::SAVE_CONTACT_ADDRESS_NOT_BLANK_CODE]])
        ]);

        $metadata->addPropertyConstraints('phone', [
            new NotBlank(['payload' => [BaseUseCase::ERROR_CODE => Error::SAVE_CONTACT_PHONE_NOT_BLANK_CODE]]),
            new Regex([
                'pattern' => '/^49(\d){10}$/i'
            ],
                null, null, null, null, null,
                [BaseUseCase::ERROR_CODE => Error::SAVE_CONTACT_PHONE_REGEX_CODE])
        ]);

        $metadata->addPropertyConstraints('birthday', [
            new NotBlank(['payload' => [BaseUseCase::ERROR_CODE => Error::SAVE_CONTACT_BIRTHDAY_NOT_BLANK_CODE]]),
            new DateTime('Y-m-d', null, null, [BaseUseCase::ERROR_CODE => Error::SAVE_CONTACT_BIRTHDAY_NOT_VALID_DATETIME_CODE])
        ]);

        $metadata->addPropertyConstraints('email', [
            new NotBlank(['payload' => [BaseUseCase::ERROR_CODE => Error::SAVE_CONTACT_EMAIL_NOT_BLANK_CODE]]),
            new Email(['payload' => [BaseUseCase::ERROR_CODE => Error::SAVE_CONTACT_EMAIL_NO_VALID_EMAIL_CODE]])
        ]);

        $metadata->addPropertyConstraints('picture', [
            new File([
                'maxSize' => PictureService::MAX_SIZE,
                'mimeTypes' => [
                    'image/png',
                    'image/jpeg',
                ],
            ])
        ]);
    }
}