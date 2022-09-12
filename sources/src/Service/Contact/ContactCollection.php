<?php

declare(strict_types=1);


namespace App\Service\Contact;

use App\Collection\BaseCollection;
use App\Service\Contact\Entity\Contact;

class ContactCollection extends BaseCollection
{
    protected string $elementClass = Contact::class;
}