<?php

declare(strict_types=1);


namespace App\Service\Contact;

use App\Collection\BaseCollection;
use App\Service\Contact\Entity\Contact;

class ContactCollection extends BaseCollection
{
    protected string $elementClass = Contact::class;

    public function toArray(): array
    {
        $result = [];

        /**
         * @var Contact $el
         */
        foreach ($this->elements as $el) {
            $result[] = [
                'first_name' => $el->getFirstName(),
                'last_name' => $el->getLastName(),
                'address' => $el->getAddress(),
                'phone' => $el->getPhone(),
                'birthday' => $el->getBirthday(),
                'email' => $el->getEmail(),
                'picture' => $el->getPicture(),
            ];
        }

        return $result;
    }
}