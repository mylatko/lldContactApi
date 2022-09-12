<?php

declare(strict_types=1);


namespace App\RequestResolver\Contact;

use App\Service\Contact\DTO\UpdateContactDTO;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

class UpdateContactRequestResolver implements ArgumentValueResolverInterface
{

    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return UpdateContactDTO::class === $argument->getType();
    }

    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $firstName = (string)$request->request->get('firstName', '');
        $lastName = (string)$request->request->get('lastName', '');
        $address = (string)$request->request->get('address', '');
        $phone = (string)$request->request->get('phone', '');
        $birthday = (string)$request->request->get('birthday', '');
        $email = (string)$request->request->get('email', '');
        $picture = $request->files->get('picture');

        yield new UpdateContactDTO(
            $firstName,
            $lastName,
            $address,
            $phone,
            $birthday,
            $email,
            $picture
        );
    }
}