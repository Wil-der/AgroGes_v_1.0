<?php

namespace App\Controller;

use App\Entity\UEB;
use App\Form\UEBType;
use App\Repository\UEBRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/u/e/b')]
final class UEBController extends AbstractController
{
    #[Route(name: 'app_u_e_b_index', methods: ['GET'])]
    public function index(UEBRepository $uEBRepository): Response
    {
        return $this->render('ueb/index.html.twig', [
            'u_e_bs' => $uEBRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_u_e_b_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $uEB = new UEB();
        $form = $this->createForm(UEBType::class, $uEB);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($uEB);
            $entityManager->flush();

            return $this->redirectToRoute('app_u_e_b_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('ueb/new.html.twig', [
            'u_e_b' => $uEB,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_u_e_b_show', methods: ['GET'])]
    public function show(UEB $uEB): Response
    {
        return $this->render('ueb/show.html.twig', [
            'u_e_b' => $uEB,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_u_e_b_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, UEB $uEB, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UEBType::class, $uEB);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_u_e_b_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('ueb/edit.html.twig', [
            'u_e_b' => $uEB,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_u_e_b_delete', methods: ['POST'])]
    public function delete(Request $request, UEB $uEB, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$uEB->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($uEB);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_u_e_b_index', [], Response::HTTP_SEE_OTHER);
    }
}
