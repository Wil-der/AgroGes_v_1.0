<?php

namespace App\Controller;

use App\Entity\CentroUEB;
use App\Entity\UEB;
use App\Form\CentroUEBType;
use App\Repository\CentroUEBRepository;
use App\Repository\UEBRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/centro')]
final class CentroUEBController extends AbstractController
{
    #[Route(name: 'app_centro_u_e_b_index', methods: ['GET'])]
    public function index(CentroUEBRepository $centroUEBRepository): Response
    {
        return $this->render('centro_ueb/index.html.twig', [
            'centro_u_e_bs' => $centroUEBRepository->findAll(),
        ]);
    }

    #[Route('/{uebId}/new', name: 'app_centro_u_e_b_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, UEBRepository $uebRepository, int $uebId): Response
    {
        $centroUEB = new CentroUEB();
        $ueb = $uebRepository->findOneBy(['id' => $uebId]);
        $form = $this->createForm(CentroUEBType::class, $centroUEB);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $centroUEB->setUeb($ueb);
            $centroUEB->setTotalTrabaj($centroUEB->getCantTrabajDirecto() + $centroUEB->getCantTrabajIndirecto());
            $entityManager->persist($centroUEB);
            $entityManager->flush();

            return $this->redirectToRoute('app_ueb_show', ['id' => $ueb->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('centro_ueb/new.html.twig', [
            'centro_u_e_b' => $centroUEB,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_centro_u_e_b_show', methods: ['GET'])]
    public function show(CentroUEB $centroUEB): Response
    {
        return $this->render('centro_ueb/show.html.twig', [
            'centro_u_e_b' => $centroUEB,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_centro_u_e_b_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CentroUEB $centroUEB, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CentroUEBType::class, $centroUEB);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_ueb_show', ['id' => $centroUEB->getUEB()->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('centro_ueb/edit.html.twig', [
            'centro_u_e_b' => $centroUEB,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_centro_u_e_b_delete', methods: ['POST'])]
    public function delete(Request $request, CentroUEB $centroUEB, EntityManagerInterface $entityManager): Response
    {
        $id = $centroUEB->getUEB()->getId();
        if ($this->isCsrfTokenValid('delete'.$centroUEB->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($centroUEB);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_ueb_show', ['id' => $id], Response::HTTP_SEE_OTHER);
    }
}
