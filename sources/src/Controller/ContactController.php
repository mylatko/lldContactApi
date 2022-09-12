<?php

declare(strict_types=1);


namespace App\Controller;

use App\Response\Contact\ContactListResponse;
use App\Response\Contact\SuccessResponse;
use App\Service\Contact\DTO\SearchContactDTO;
use App\Service\Contact\DTO\DeleteContactDTO;
use App\Service\Contact\DTO\SaveContactDTO;
use App\Service\Contact\DTO\UpdateContactDTO;
use App\UseCase\ContactUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    protected ContactUseCase $contactUseCase;

    public function __construct(
        ContactUseCase $contactUseCase
    )
    {
        $this->contactUseCase = $contactUseCase;
    }

    public function get(SearchContactDTO $dto): ContactListResponse
    {
        $contactList = $this->contactUseCase->get($dto);
        return new ContactListResponse($contactList);
    }

    public function put(SaveContactDTO $dto): SuccessResponse
    {
        $this->contactUseCase->put($dto);
        return new SuccessResponse();
    }

    public function patch(UpdateContactDTO $dto): SuccessResponse
    {
        $this->contactUseCase->patch($dto);
        return new SuccessResponse();
    }

    public function delete(DeleteContactDTO $dto): SuccessResponse
    {
        $this->contactUseCase->delete($dto);
        return new SuccessResponse();
    }
}