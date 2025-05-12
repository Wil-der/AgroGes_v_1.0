<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class ArchivoUploader
{
    private string $uploadsDirectory;

    public function __construct(string $uploadsDirectory)
    {
        $this->uploadsDirectory = $uploadsDirectory;
    }

    public function upload(UploadedFile $archivo): string
    {
        $nombreArchivo = uniqid() . '.' . $archivo->guessExtension();
        $archivo->move($this->uploadsDirectory, $nombreArchivo);

        return $nombreArchivo; // Solo el nombre, sin ruta
    }
}

