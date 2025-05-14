<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\File;

class ArchivoDownloader
{
    private string $uploadsDirectory;

    public function __construct(string $uploadsDirectory)
    {
        $this->uploadsDirectory = $uploadsDirectory;
    }

    public function download(string $url, string $nombreArchivo): Response
    {
        $rutaCompleta = $this->uploadsDirectory . '/' . ltrim($url, '/');

        if (!file_exists($rutaCompleta)) {
            throw new \Exception('Archivo no encontrado');
        }

        $file = new File($rutaCompleta);

        return new Response(
            file_get_contents($rutaCompleta),
            200,
            [
                'Content-Type' => $file->getMimeType(),
                'Content-Disposition' => 'attachment; filename="' . $nombreArchivo . '"',
            ]
        );
    }
}

