<?php

namespace App\Event;

use App\Entity\EstructuraOrganizativa;
use App\Service\ArchivoRemover;

class EstructuraOrganizativaEntityListener
{
    private ArchivoRemover $archivoRemover;

    public function __construct(ArchivoRemover $archivoRemover)
    {
        $this->archivoRemover = $archivoRemover;
    }

    public function preRemove(EstructuraOrganizativa $estructuraOrganizativa): void
    {
        if ($estructuraOrganizativa->getUrl()) {
            $this->archivoRemover->eliminarArchivo($estructuraOrganizativa->getUrl());
        }
    }
}
