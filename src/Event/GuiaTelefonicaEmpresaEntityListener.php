<?php

namespace App\Event;

use App\Entity\GuiaTelefonicaEmpresa;
use App\Service\ArchivoRemover;

class GuiaTelefonicaEmpresaEntityListener
{
    private ArchivoRemover $archivoRemover;

    public function __construct(ArchivoRemover $archivoRemover)
    {
        $this->archivoRemover = $archivoRemover;
    }

    public function preRemove(GuiaTelefonicaEmpresa $guiaTelefonicaEmpresa): void
    {
        if ($guiaTelefonicaEmpresa->getUrl()) {
            $this->archivoRemover->eliminarArchivo($guiaTelefonicaEmpresa->getUrl());
        }
    }
}