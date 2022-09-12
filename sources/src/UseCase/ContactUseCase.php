<?php

declare(strict_types=1);


namespace App\UseCase;

use App\Error;
use App\Service\Contact\ContactCollection;
use App\Service\Contact\DTO\DeleteContactDTO;
use App\Service\Contact\DTO\SaveContactDTO;
use App\Service\Contact\DTO\SearchContactDTO;
use App\Service\Contact\DTO\UpdateContactDTO;
use App\Service\Contact\Repository\ContactRepository;
use App\Service\Picture\PictureService;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ContactUseCase extends BaseUseCase
{
    protected ContactRepository $repository;
    protected PictureService $pictureService;

    public function __construct(
        ValidatorInterface $validator,
        ContactRepository $repository,
        PictureService $pictureService,
    )
    {
        $this->repository = $repository;
        $this->pictureService = $pictureService;

        parent::__construct($validator);
    }

    public function get(SearchContactDTO $dto):? ContactCollection
    {
        $this->validate($dto);

        $contactArray = $this->repository->findByName($dto->getName());

        return new ContactCollection($contactArray);
    }

    public function put(SaveContactDTO $dto)
    {
        $this->validate($dto);

        $imageLink = null;
        if (null !== $dto->getPicture()) {
            $this->pictureService->save($dto->getPicture());
        }

        try {
            $this->repository->store($dto, $imageLink);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), Error::SAVE_CONTACT_DB_EXCEPTION_CODE);
        }
    }

    public function patch(UpdateContactDTO $dto)
    {
        $this->validate($dto);
    }

    public function delete(DeleteContactDTO $dto)
    {
        $this->validate($dto);


    }
}