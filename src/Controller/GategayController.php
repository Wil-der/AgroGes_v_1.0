<?php

namespace App\Controller;

use App\Entity\EstructuraOrganizativa;
use App\Entity\GuiaTelefonica;
use App\Entity\Osde;
use App\Form\OsdeType;
use App\Repository\OsdeRepository;
use App\Service\ArchivoDownloader;
use App\Service\ArchivoRemover;
use App\Service\ArchivoUploader;
use App\Service\CubadebateService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;


final class GategayController extends AbstractController
{

    #[Route('/', name: 'app_home')]
    public function index(OsdeRepository $osde): Response
    {
        return $this->render('home.html.twig', [
            'osde' => $osde->findOneBy(['id' => 1]),
        ]);
    }

    #[Route('/osde-edit', name: 'app_osde_edit')]
    public function osdeEdit(
        Request $request,
        ArchivoUploader $archivoUploader,
        OsdeRepository $osdeRepository,
        EntityManagerInterface $entityManager,
    ): Response {
        $osde = $osdeRepository->find(1) ?? new Osde();

        $form = $this->createForm(OsdeType::class, $osde);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Guardar OSDE primero si es nuevo
            $entityManager->persist($osde);

            // Procesar estructura organizativa
            $estructuraFile = $form->get('estructuraOrganizativa')->getData();
            if ($estructuraFile) {
                foreach ($osde->getEstructuraOrganizativa() as $estructuraAntigua) {
                    $entityManager->remove($estructuraAntigua);
                }
                $estructura = new EstructuraOrganizativa();
                $estructura->setName($estructuraFile->getClientOriginalName());
                $estructura->setMimeType($estructuraFile->getClientMimeType());
                $estructura->setUrl($archivoUploader->upload($estructuraFile));
                $estructura->setOsde($osde);
                $entityManager->persist($estructura);
            }

            // Procesar guía telefónica
            $guiaFile = $form->get('guiaTelefonica')->getData();
            if ($guiaFile) {
                foreach ($osde->getGuiaTelefonica() as $guiaAntigua) {
                    $entityManager->remove($guiaAntigua);
                }
                $guia = new GuiaTelefonica();
                $guia->setName($guiaFile->getClientOriginalName());
                $guia->setMimeType($guiaFile->getClientMimeType());
                $guia->setUrl($archivoUploader->upload($guiaFile));
                $guia->setOsde($osde);
                $entityManager->persist($guia);
            }

            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('gategay/edit.html.twig', [
            'osde' => $osde,
            'form' => $form,
        ]);
    }

    #[Route('/guia-telefonica/download', name: 'app_guia_telefonica_download')]
    public function downloadGuiaTelefonica(
        OsdeRepository $osdeRepository,
        ArchivoDownloader $archivoDownloader
    ): Response {
        $osde = $osdeRepository->find(1);

        if (!$osde || $osde->getGuiaTelefonica()->isEmpty()) {
            throw new NotFoundHttpException('No hay archivo de Guía Telefónica disponible.');
        }

        $guia = $osde->getGuiaTelefonica()->last();

        return $archivoDownloader->download($guia->getUrl(), $guia->getName());
    }


    #[Route('/estructura-organizativa/download', name: 'app_estructura_organizativa_download')]
    public function downloadEstructuraOrganizativa(
        OsdeRepository $osdeRepository,
        ArchivoDownloader $archivoDownloader
    ): Response {
        $osde = $osdeRepository->find(1);

        if (!$osde || $osde->getEstructuraOrganizativa()->isEmpty()) {
            throw new NotFoundHttpException('No hay archivo disponible para descargar.');
        }

        $estructura = $osde->getEstructuraOrganizativa()->last();

        return $archivoDownloader->download($estructura->getUrl(), $estructura->getName());
    }



    #[Route('/noticias', name: 'app_noticias')]
    public function cubadebate(CubadebateService $cubadebate): Response
    {
        return $this->render('cuabadebate.html.twig', [
            'content' => $cubadebate->obtenerContenidoNoticias(),
        ]);
    }
}
