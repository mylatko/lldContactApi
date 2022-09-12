<?php

declare(strict_types=1);


namespace App\Response\Contact;

use App\Response\BaseResponse;
use App\Service\Contact\ContactCollection;

class ContactListResponse extends BaseResponse
{
    protected ContactCollection $contacts;

    public function __construct(
        ContactCollection $contacts
    )
    {
        $this->contacts = $contacts;
    }

    public function getOutput(): array
    {
        return [
            'data' => $this->contacts->toArray(),
            'errors' => []
        ];
    }
}