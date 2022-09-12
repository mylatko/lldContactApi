<?php

declare(strict_types=1);


namespace App\Response;

use Symfony\Component\HttpFoundation\JsonResponse;

abstract class BaseResponse extends JsonResponse
{
    public function sendContent(): static
    {
        $output = $this->getOutput();
        $this->setData($output);

        return parent::sendContent();
    }

    abstract public function getOutput(): array;
}