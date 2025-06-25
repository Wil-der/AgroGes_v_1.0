<?php

namespace App\Tests\Service;

use App\Service\ArchivoDownloader;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

class ArchivoDownloaderTest extends TestCase
{
    private string $uploadsDirectory;
    private string $archivoPrueba;

    protected function setUp(): void
    {
        // Crear un directorio temporal
        $this->uploadsDirectory = sys_get_temp_dir() . '/uploads_test';
        if (!is_dir($this->uploadsDirectory)) {
            mkdir($this->uploadsDirectory);
        }

        // Crear un archivo de prueba
        $this->archivoPrueba = $this->uploadsDirectory . '/archivo.txt';
        file_put_contents($this->archivoPrueba, 'Contenido de prueba');
    }

    protected function tearDown(): void
    {
        // Limpiar el archivo y directorio después de la prueba
        if (file_exists($this->archivoPrueba)) {
            unlink($this->archivoPrueba);
        }

        if (is_dir($this->uploadsDirectory)) {
            rmdir($this->uploadsDirectory);
        }
    }

    public function testDownloadDevuelveResponseConArchivo()
    {
        $downloader = new ArchivoDownloader($this->uploadsDirectory);

        $response = $downloader->download('archivo.txt', 'descarga.txt');

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('Contenido de prueba', $response->getContent());
        $this->assertStringContainsString('attachment; filename="descarga.txt"', $response->headers->get('Content-Disposition'));
    }

    public function testDownloadArchivoNoExiste()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Archivo no encontrado');

        $downloader = new ArchivoDownloader($this->uploadsDirectory);
        $downloader->download('no-existe.txt', 'cualquiera.txt');
    }
}
