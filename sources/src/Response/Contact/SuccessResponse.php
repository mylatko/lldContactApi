<?php

declare(strict_types=1);


namespace App\Response\Contact;

use App\Response\BaseResponse;

class SuccessResponse extends BaseResponse
{
    public function getOutput(): array
    {
        return [
            'data' => [
                'status' => 'success'
            ],
            'errors' => []
        ];
    }
}