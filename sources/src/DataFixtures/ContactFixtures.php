<?php

namespace App\DataFixtures;

use App\Service\Contact\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ContactFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $contact = new Contact();
        $contact->setFirstName('Apfel');
        $contact->setLastName('Gurke');
        $contact->setAddress('Munchen, Leopold Str 187');
        $contact->setPhone('491122334455');
        $contact->setBirthday('1995-05-05');
        $contact->setEmail('apfel.gurke@gmail.com');
        $contact->setPicture('http://static.host/abc/def/ghj/abcdefghj123.jpg');
        $manager->persist($contact);

        $manager->flush();
    }
}
