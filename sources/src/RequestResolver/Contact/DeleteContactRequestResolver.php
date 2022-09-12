<?php

declare(strict_types=1);


namespace App\RequestResolver\Contact;

use App\Service\Contact\DTO\DeleteContactDTO;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

class DeleteContactRequestResolver implements ArgumentValueResolverInterface
{

    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return DeleteContactDTO::class === $argument->getType();
    }

    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $name = $request->get('name', null);

        yield new DeleteContactDTO(
            $name
        );
    }
}