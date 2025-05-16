<?php

namespace App\Controller;

use App\Entity\Empresa;
use App\Entity\UEB;
use App\Form\UEBType;
use App\Repository\CentroUEBRepository;
use App\Repository\EmpresaRepository;
use App\Repository\UEBRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/ueb')]
final class UEBController extends AbstractController
{
    #[Route('/new', name: 'app_ueb_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, EmpresaRepository $empresaRepository): Response
    {
        $uEB = new UEB();
        $empresa = $empresaRepository->findOneBy(['id' => $this->getUser()->getEmpresa()->getId()]);
        $form = $this->createForm(UEBType::class, $uEB);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $uEB->setEmpresa($empresa);
            $uEB->setTotalTrabaj($uEB->getCantTrabajDirecto() + $uEB->getCantTrabajIndirecto());
            $entityManager->persist($uEB);
            $entityManager->flush();

            return $this->redirectToRoute('app_empresa_show', ['id' => $empresa->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('ueb/new.html.twig', [
            'ueb' => $uEB,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ueb_show', methods: ['GET'])]
    public function show(UEB $uEB, CentroUEBRepository $centroUEBRepository): Response
    {
        return $this->render('ueb/show.html.twig', [
            'ueb' => $uEB,
            'centros' => $centroUEBRepository->findBy(['uEB' => $uEB])
        ]);
    }

    #[Route('/{id}/edit', name: 'app_ueb_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, UEB $uEB, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UEBType::class, $uEB);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $uEB->setTotalTrabaj($uEB->getCantTrabajDirecto() + $uEB->getCantTrabajIndirecto());
            $entityManager->flush();

            return $this->redirectToRoute('app_empresa_show', ['id' => $uEB->getEmpresa()->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('ueb/edit.html.twig', [
            'ueb' => $uEB,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ueb_delete', methods: ['POST'])]
    public function delete(Request $request, UEB $uEB, EntityManagerInterface $entityManager): Response
    {
        $id = $uEB->getEmpresa()->getId();
        if ($this->isCsrfTokenValid('delete'.$uEB->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($uEB);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_empresa_show', ['id' => $id], Response::HTTP_SEE_OTHER);
    }
}
