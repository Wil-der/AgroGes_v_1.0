<?php

namespace App\Event;

use App\Entity\GuiaTelefonica;
use App\Service\ArchivoRemover;

class GuiaTelefonicaEntityListener
{
    private ArchivoRemover $archivoRemover;

    public function __construct(ArchivoRemover $archivoRemover)
    {
        $this->archivoRemover = $archivoRemover;
    }

    public function preRemove(GuiaTelefonica $guiaTelefonica): void
    {
        if ($guiaTelefonica->getUrl()) {
            $this->archivoRemover->eliminarArchivo($guiaTelefonica->getUrl());
        }
    }
}
