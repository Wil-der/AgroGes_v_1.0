<?php

namespace App\Service;

class ArchivoRemover
{
    private string $uploadsDirectory;

    public function __construct(string $uploadsDirectory)
    {
        $this->uploadsDirectory = $uploadsDirectory;
    }

    public function eliminarArchivo(string $nombreArchivo): void
    {
        $ruta = $this->uploadsDirectory . '/' . ltrim($nombreArchivo, '/');

        if (file_exists($ruta)) {
            unlink($ruta);
        }
    }
}
