<?php

namespace App\Controller;

use App\Entity\Empresa;
use App\Entity\EstructuraOrganizativaEmpresa;
use App\Entity\GuiaTelefonicaEmpresa;
use App\Form\EmpresaType;
use App\Repository\EmpresaRepository;
use App\Service\ArchivoDownloader;
use App\Service\ArchivoUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/empresa')]
final class EmpresaController extends AbstractController
{
    #[Route(name: 'app_empresa_index', methods: ['GET'])]
    public function index(EmpresaRepository $empresaRepository): Response
    {
        return $this->render('empresa/index.html.twig', [
            'empresas' => $empresaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_empresa_new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $entityManager,
        ArchivoUploader $archivoUploader
    ): Response {
        $empresa = new Empresa();
        $form = $this->createForm(EmpresaType::class, $empresa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Procesar estructura organizativa
            $estructuraFile = $form->get('estructuraOrganizativa')->getData();
            $this->handleEstructuraOrganizativa($empresa, $estructuraFile, $entityManager, $archivoUploader);

            // Procesar guía telefónica
            $guiaFile = $form->get('guiaTelefonica')->getData();
            $this->handleGuiaTelefonica($empresa, $guiaFile, $entityManager, $archivoUploader);

            // Persistir la nueva empresa
            $empresa->setTotalTrabaj($empresa->getCantTrabajDirecto() + $empresa->getCantTrabajIndirecto());
            $entityManager->persist($empresa);
            $entityManager->flush();

            return $this->redirectToRoute('app_empresa_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('empresa/new.html.twig', [
            'empresa' => $empresa,
            'form' => $form,
        ]);
    }


    #[Route('/{id}', name: 'app_empresa_show', methods: ['GET'])]
    public function show(Empresa $empresa): Response
    {
        $uebs = $empresa->getUeb();
        return $this->render('empresa/show.html.twig', [
            'empresa' => $empresa,
            'uebs' => $uebs
        ]);
        
    }

    #[Route('/{id}/edit', name: 'app_empresa_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        Empresa $empresa,
        EntityManagerInterface $entityManager,
        ArchivoUploader $archivoUploader // Asegúrate de inyectar ArchivoUploader
    ): Response {
        $form = $this->createForm(EmpresaType::class, $empresa);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Procesar estructura organizativa
            $estructuraFile = $form->get('estructuraOrganizativa')->getData();
            $this->handleEstructuraOrganizativa($empresa, $estructuraFile, $entityManager, $archivoUploader);
    
            // Procesar guía telefónica
            $guiaFile = $form->get('guiaTelefonica')->getData();
            $this->handleGuiaTelefonica($empresa, $guiaFile, $entityManager, $archivoUploader);
    
            // Persistir los cambios
            $entityManager->flush();
    
            return $this->redirectToRoute('app_empresa_index', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->render('empresa/edit.html.twig', [
            'empresa' => $empresa,
            'form' => $form,
        ]);
    }
    
    #[Route('/{id}', name: 'app_empresa_delete', methods: ['POST'])]
    public function delete(Request $request, Empresa $empresa, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $empresa->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($empresa);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_empresa_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/empresa/{id}/download/estructura', name: 'app_empresa_download_estructura', methods: ['GET'])]
    public function downloadEstructura(
        Empresa $empresa,
        ArchivoDownloader $archivoDownloader
    ): Response {
        if (!$empresa->getEstructuraOrganizativa()) {
            throw new NotFoundHttpException('No hay archivo de Estructura Organizativa disponible.');
        }

        $estructura = $empresa->getEstructuraOrganizativa();

        return $archivoDownloader->download($estructura->getUrl(), $estructura->getName());
    }

    #[Route('/empresa/{id}/download/guia', name: 'app_empresa_download_guia', methods: ['GET'])]
    public function downloadGuiaTelefonica(
        Empresa $empresa,
        ArchivoDownloader $archivoDownloader
    ): Response {
        if ($empresa->getGuiaTelefonica()->isEmpty()) {
            throw new NotFoundHttpException('No hay archivo de Guía Telefónica disponible.');
        }

        $guia = $empresa->getGuiaTelefonica()->last();

        return $archivoDownloader->download($guia->getUrl(), $guia->getName());
    }


    private function handleEstructuraOrganizativa(
        Empresa $empresa,
        $estructuraFile,
        EntityManagerInterface $entityManager,
        ArchivoUploader $archivoUploader
    ): void {
        if ($estructuraFile) {
            // Eliminar la estructura organizativa anterior si existe
            if ($empresa->getEstructuraOrganizativa()) {
                $entityManager->remove($empresa->getEstructuraOrganizativa());
            }

            $estructura = new EstructuraOrganizativaEmpresa();
            $estructura->setName($estructuraFile->getClientOriginalName());
            $estructura->setMimeType($estructuraFile->getClientMimeType());
            $estructura->setUrl($archivoUploader->upload($estructuraFile));
            $entityManager->persist($estructura);
            $empresa->setEstructuraOrganizativa($estructura);
        }
    }

    private function handleGuiaTelefonica(
        Empresa $empresa,
        $guiaFile,
        EntityManagerInterface $entityManager,
        ArchivoUploader $archivoUploader
    ): void {
        if ($guiaFile) {
            // Eliminar la guía telefónica anterior si existe
            foreach ($empresa->getGuiaTelefonica() as $guiaAntigua) {
                $entityManager->remove($guiaAntigua);
            }

            $guia = new GuiaTelefonicaEmpresa();
            $guia->setName($guiaFile->getClientOriginalName());
            $guia->setMimeType($guiaFile->getClientMimeType());
            $guia->setUrl($archivoUploader->upload($guiaFile));
            $guia->setEmpresa($empresa);
            $entityManager->persist($guia);
        }
    }
}
