<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Service\ArchivoUploader;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ArchivoUploaderTest extends TestCase
{
    public function testUploadDevuelveNombreDeArchivo()
    {
        $archivo = $this->createMock(UploadedFile::class);

        $archivo->method('guessExtension')
            ->willReturn('txt');

        $archivo->expects($this->once())
            ->method('move')
            ->with(
                $this->anything(), // la carpeta
                $this->matchesRegularExpression('/^\w+\.txt$/')
            );

        $uploader = new ArchivoUploader('/fake/directory');

        $nombre = $uploader->upload($archivo);

        $this->assertMatchesRegularExpression('/^\w+\.txt$/', $nombre);
    }
}
