<?php

namespace App\Event;

use App\Entity\EstructuraOrganizativaEmpresa;
use App\Service\ArchivoRemover;

class EstructuraOrganizativaEmpresaEntityListener
{
    private ArchivoRemover $archivoRemover;

    public function __construct(ArchivoRemover $archivoRemover)
    {
        $this->archivoRemover = $archivoRemover;
    }

    public function preRemove(EstructuraOrganizativaEmpresa $estructuraOrganizativaEmpresa): void
    {
        if ($estructuraOrganizativaEmpresa->getUrl()) {
            $this->archivoRemover->eliminarArchivo($estructuraOrganizativaEmpresa->getUrl());
        }
    }
}