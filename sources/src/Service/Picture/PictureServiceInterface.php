<?php

declare(strict_types=1);


namespace App\Service\Picture;

use Symfony\Component\HttpFoundation\File\UploadedFile;

interface PictureServiceInterface
{
    public function save(UploadedFile $file): string;
}