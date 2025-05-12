<?php

namespace App\Event;

use App\Entity\File;
use App\Service\ArchivoRemover;
use Doctrine\ORM\Event\LifecycleEventArgs;

class FileEntityListener
{
    private ArchivoRemover $archivoRemover;

    public function __construct(ArchivoRemover $archivoRemover)
    {
        $this->archivoRemover = $archivoRemover;
    }

    public function preRemove(File $file): void
    {
        if ($file->getUrl()) {
            $this->archivoRemover->eliminarArchivo($file->getUrl());
        }
    }
}
