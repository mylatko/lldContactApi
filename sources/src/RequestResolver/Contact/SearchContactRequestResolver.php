<?php

declare(strict_types=1);


namespace App\RequestResolver\Contact;

use App\Service\Contact\DTO\SearchContactDTO;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

class SearchContactRequestResolver implements ArgumentValueResolverInterface
{

    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return SearchContactDTO::class === $argument->getType();
    }

    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $name = $request->get('name', null);

        yield new SearchContactDTO(
            $name
        );
    }
}