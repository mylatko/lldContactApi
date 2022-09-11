<?php

declare(strict_types=1);


namespace App\Controller;

use InvalidArgumentException;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DocsController
{
    public function index()
    {
        ob_start();
        $title = 'Phone book docs';
        require __DIR__ . '/../../templates/main.php';
        $content = ob_get_clean();

        return new Response($content, 200, ['Content-Type' => 'text/html']);
    }

    public function json()
    {
        $filePath = __DIR__ . '/../../docs/api.json';

        if (!file_exists($filePath)) {
            $fileNotFound = '{"swagger": "2.0",
            "info": {
            "version": "1.0.0",
            "title": "Phone book",
            "description": "Sorry api.json file not found",
          },}';
            return new JsonResponse($fileNotFound, 200, [], true);
        }

        $yamlUserFiles = file_get_contents($filePath);
        return new JsonResponse($yamlUserFiles, 200, [], true);
    }
}