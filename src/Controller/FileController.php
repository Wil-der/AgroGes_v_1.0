<?php

namespace App\Controller;

use App\Entity\Especialidad;
use App\Entity\File;
use App\Form\FileType;
use App\Repository\FileRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\ArchivoUploader;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Service\ArchivoDownloader;

#[Route('/file')]
final class FileController extends AbstractController
{
    #[Route('/especialidad/{id}', name: 'app_file_index', methods: ['GET'])]
    public function index(FileRepository $fileRepository, Especialidad $especialidad): Response
    {
        $files = $fileRepository->findBy(['especialidad' => $especialidad]);

        return $this->render('file/index.html.twig', [
            'files' =>  $files,
        ]);
    }

    #[Route('/new', name: 'app_file_new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $entityManager,
        Security $security,
        ArchivoUploader $archivoUploader
    ): Response {

        $file = new File();
        $form = $this->createForm(FileType::class, $file);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form->get('fileUpload')->getData();

            if ($uploadedFile) {
                $nombreArchivo = $archivoUploader->upload($uploadedFile);
                $file->setUrl($nombreArchivo);
                $file->setMimeType($uploadedFile->getClientMimeType());
            }

            $file->setFechaSubida(new \DateTime());

            /** @var \App\Entity\User $user */
            $user = $security->getUser();
            if ($user->getEspecialidad()) {
                $file->setEspecialidad($user->getEspecialidad());
            }

            $entityManager->persist($file);
            $entityManager->flush();

            return $this->redirectToRoute('app_file_index', ['id' => $user->getEspecialidad()->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('file/new.html.twig', [
            'file' => $file,
            'form' => $form,
        ]);
    }


    #[Route('/download/{id}', name: 'app_file_download')]
    public function download(
        int $id,
        FileRepository $fileRepository,
        ArchivoDownloader $archivoDownloader
    ): Response {
        $file = $fileRepository->find($id);

        if (!$file) {
            throw $this->createNotFoundException('Archivo no encontrado.');
        }

        return $archivoDownloader->download($file->getUrl(), $file->getName());
    }


    #[Route('/{id}/edit', name: 'app_file_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, File $file, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FileType::class, $file);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_file_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('file/edit.html.twig', [
            'file' => $file,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_file_delete', methods: ['POST'])]
    public function delete(Request $request, File $file, EntityManagerInterface $entityManager): Response
    {

        $id = $file->getEspecialidad()->getId();
        if ($this->isCsrfTokenValid('delete' . $file->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($file);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_file_index', ['id' => $id], Response::HTTP_SEE_OTHER);
    }
}
