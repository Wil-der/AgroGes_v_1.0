<?php

namespace App\Tests\Service;

use App\Service\ArchivoRemover;
use PHPUnit\Framework\TestCase;

class ArchivoRemoverTest extends TestCase
{
    private string $uploadsDirectory;
    private string $archivoPrueba;

    protected function setUp(): void
    {
        // Crear un directorio temporal
        $this->uploadsDirectory = sys_get_temp_dir() . '/uploads_remover_test';
        if (!is_dir($this->uploadsDirectory)) {
            mkdir($this->uploadsDirectory);
        }

        // Crear un archivo de prueba
        $this->archivoPrueba = $this->uploadsDirectory . '/archivo.txt';
        file_put_contents($this->archivoPrueba, 'contenido');
    }

    protected function tearDown(): void
    {
        // Eliminar cualquier archivo que haya quedado
        if (file_exists($this->archivoPrueba)) {
            unlink($this->archivoPrueba);
        }

        if (is_dir($this->uploadsDirectory)) {
            rmdir($this->uploadsDirectory);
        }
    }

    public function testEliminarArchivoEliminaElArchivo()
    {
        $this->assertFileExists($this->archivoPrueba);

        $remover = new ArchivoRemover($this->uploadsDirectory);
        $remover->eliminarArchivo('archivo.txt');

        $this->assertFileDoesNotExist($this->archivoPrueba);
    }

    public function testEliminarArchivoInexistenteNoLanzaError()
    {
        $remover = new ArchivoRemover($this->uploadsDirectory);

        // Esto no debería lanzar una excepción
        $remover->eliminarArchivo('no_existe.txt');

        // Si no hay excepciones, la prueba pasa
        $this->assertTrue(true);
    }
}
