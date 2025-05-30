<?php

namespace App\Controller;

use App\Entity\AsociacionSeccion;
use App\Entity\Empresa;
use App\Entity\ParteDiario;
use App\Entity\ParteGeneral;
use App\Entity\UEB;
use App\Form\ConfgType;
use App\Repository\CentroRepository;
use App\Repository\EmpresaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/confg')]
final class AjustesController extends AbstractController
{

    #[Route(name: 'app_ajustes_index', methods: ['GET', 'POST'])]
    public function asignar(Request $request, EntityManagerInterface $em)
    {
        $empresas = $em->getRepository(Empresa::class)->findAll();
        $centros = $em->getRepository(UEB::class)->findAll();

        $asociacionesDB = $em->getRepository(AsociacionSeccion::class)->findAll();
        $asociaciones = [];
        foreach ($asociacionesDB as $asoc) {
            $keyEmpresa = $asoc->getEmpresa() ? 'empresa_' . $asoc->getEmpresa()->getId() : null;
            $keyCentro = $asoc->getCentro() ? 'centro_' . $asoc->getCentro()->getId() : null;
            $seccion = $asoc->getSeccion();

            if (!isset($asociaciones[$seccion])) {
                $asociaciones[$seccion] = [];
            }
            if ($keyEmpresa) $asociaciones[$seccion][] = $keyEmpresa;
            if ($keyCentro) $asociaciones[$seccion][] = $keyCentro;
        }

        $secciones = [
            'contenedores' => 'Contenedores',
            'campana1' => 'Campaña 1',
            'campana2' => 'Campaña 2',
            'combustible' => 'Combustible',
            'equipoRiego' => 'Equipo de Riego',
            'extraccionCombustible' => 'Extracción de Combustible',
            'hechosExtraordinarios' => 'Hechos Extraordinarios',
            'maquinaIngeniera' => 'Máquina Ingeniera',
            'mortalidad' => 'Mortalidad',
            'nacimientos' => 'Nacimientos',
            'peces' => 'Peces',
            'pienso' => 'Pienso',
            'produccionHuevos' => 'Producción de Huevos',
            'transportacion' => 'Transportación',
        ];

        $form = $this->createForm(ConfgType::class, null, [
            'secciones' => $secciones,
            'empresas' => array_map(fn($e) => ['id' => $e->getId(), 'nombre' => $e->getName()], $empresas),
            'centros' => array_map(fn($c) => ['id' => $c->getId(), 'nombre' => $c->getName(), 'empresaId' => $c->getEmpresa()->getId()], $centros),
            'asociaciones' => $asociaciones,
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Obtenemos los datos del formulario manualmente
            $submitted = $request->request->all('confg');
            unset($submitted['_token']);

            if (!is_array($submitted)) {
                $submitted = [];
            }


            $asociacionesActuales = [];
            foreach ($asociacionesDB as $asoc) {
                $clave = sprintf(
                    '%s_%s_%s',
                    $asoc->getSeccion(),
                    $asoc->getEmpresa()?->getId() ?? 'null',
                    $asoc->getCentro()?->getId() ?? 'null'
                );
                $asociacionesActuales[$clave] = $asoc;
            }

            $seleccionadas = [];


            foreach ($submitted as $seccionKey => $selecciones) {
                if (!is_array($selecciones)) continue;

                foreach ($selecciones as $clave => $valor) {
                    if (!$valor) continue;

                    $id = (int) filter_var($clave, FILTER_SANITIZE_NUMBER_INT);
                    $isEmpresa = str_starts_with($clave, 'empresa_');
                    $isCentro = str_starts_with($clave, 'centro_');

                    $empresa = $isEmpresa ? $em->getRepository(Empresa::class)->find($id) : null;
                    $centro = $isCentro ? $em->getRepository(UEB::class)->find($id) : null;

                    if ($isCentro) {
                        $empresaDelCentro = $centro->getEmpresa();
                        $empresaKey = 'empresa_' . $empresaDelCentro->getId();
                        if (!isset($selecciones[$empresaKey]) || !$selecciones[$empresaKey]) {
                            continue; // Si la empresa no está marcada, se ignora el centro
                        }
                    }

                    $claveUnica = sprintf('%s_%s_%s', $seccionKey, $empresa?->getId() ?? 'null', $centro?->getId() ?? 'null');
                    $seleccionadas[] = $claveUnica;

                    if (!isset($asociacionesActuales[$claveUnica])) {
                        $asoc = new AsociacionSeccion();
                        $asoc->setEmpresa($empresa);
                        $asoc->setCentro($centro);
                        $asoc->setSeccion($seccionKey);
                        $em->persist($asoc);
                    } else {
                        unset($asociacionesActuales[$claveUnica]); // Ya existe, no se elimina
                    }
                }
            }

            // Eliminar las asociaciones que ya no están seleccionadas
            foreach ($asociacionesActuales as $asoc) {
                $em->remove($asoc);
            }

            $em->flush();

            $this->addFlash('success', 'Asociaciones guardadas correctamente.');
            return $this->redirectToRoute('app_home');
        }

        return $this->render('parte_diario/confg.html.twig', [
            'form' => $form->createView(),
            'secciones' => $secciones,
            'empresas' => $empresas,
            'centros' => $centros,
        ]);
    }


}
