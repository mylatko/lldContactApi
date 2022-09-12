<?php

declare(strict_types=1);


namespace App\Response\Contact;

use App\Response\BaseResponse;
use App\Service\Contact\ContactCollection;

class ContactListResponse extends BaseResponse
{
    protected ?ContactCollection $contacts;

    public function __construct(
        ?ContactCollection $contacts
    )
    {
        $this->contacts = $contacts;
        parent::__construct();
    }

    public function getOutput(): array
    {
        return [
            'data' => null !== $this->contacts ? $this->contacts->toArray() : [],
            'errors' => []
        ];
    }
}