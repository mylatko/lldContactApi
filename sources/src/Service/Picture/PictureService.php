<?php

declare(strict_types=1);


namespace App\Service\Picture;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class PictureService implements PictureServiceInterface
{
    public const DIR_LENGTH = 2;
    public const MAX_SIZE = '1024k';

    public function save(UploadedFile $file): string
    {
        $name = md5($file->getFilename() . time()) . "." . $file->getExtension();

        $dir = $this->createDir($name);
        $path = $dir . $name;

        $file->move($dir, $name);

        return $path;
    }

    private function createDir($name)
    {
        $defaultDir = __DIR__ . '/../../../public/pictures/';
        $dir1 = $defaultDir . substr($name, 0, self::DIR_LENGTH);
        $dir2 = $dir1 . '/' . substr($name, self::DIR_LENGTH, self::DIR_LENGTH);
        $dir3 = $dir2 . '/' . substr($name, self::DIR_LENGTH * 2, self::DIR_LENGTH);

        if (!is_dir($dir1)) {
            if (!mkdir($dir1) && !is_dir($dir1)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $dir1));
            }
        }

        if (!is_dir($dir2)) {
            if (!mkdir($dir2) && !is_dir($dir2)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $dir2));
            }
        }

        if (!is_dir($dir3)) {
            if (!mkdir($dir3) && !is_dir($dir3)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $dir3));
            }
        }

        return $dir3 . '/';
    }
}