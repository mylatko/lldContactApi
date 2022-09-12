<?php

declare(strict_types=1);


namespace App\RequestResolver\Contact;

use App\Service\Contact\DTO\SaveContactDTO;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

class SaveContactRequestResolver implements ArgumentValueResolverInterface
{

    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return SaveContactDTO::class === $argument->getType();
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

        yield new SaveContactDTO(
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