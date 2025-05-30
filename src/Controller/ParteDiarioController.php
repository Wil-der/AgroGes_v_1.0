<?php

namespace App\Controller;

use App\Entity\Empresa;
use App\Entity\ParteDiario;
use App\Form\ParteDiarioType;
use App\Repository\AsociacionSeccionRepository;
use App\Repository\ParteDiarioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/parte-diario')]
final class ParteDiarioController extends AbstractController
{
    #[Route(name: 'app_parte_diario_index', methods: ['GET'])]
    public function index(ParteDiarioRepository $parteDiarioRepository): Response
    {
        return $this->render('parte_diario/index.html.twig', [
            'parte_diarios' => $parteDiarioRepository->findAll(),
        ]);
    }

    #[Route(name: 'app_parte_diario_centro_new', methods: ['GET'])]
    public function centroIndex(): Response
    {
        return $this->render('parte_diario/centro_index.html.twig', [
            'centro_peces' => null,
        ]);
    }

    #[Route('/new', name: 'app_parte_diario_new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        AsociacionSeccionRepository $asociacionRepository,
        EntityManagerInterface $entityManager
    ): Response {
        $parteDiario = new ParteDiario();

        $user = $this->getUser();
        $empresa = null;

        // Obtener la empresa del usuario si está disponible
        if ($user !== null && $user->getEmpresa() !== null) {
            $empresa = $user->getEmpresa()->getName(); // Lo envolvemos en un array
        } else {
            return $this->redirectToRoute('login');
        }

        // Obtener asociaciones activas
        // $asociaciones = $asociacionRepository->findAsociacionesActivas();

        // // Agrupar empresas y centros por sección (string)
        // $empresasPorSeccion = [];
        // $centrosPorSeccion = [];

        // foreach ($asociaciones as $asociacion) {
        //     $seccion = $asociacion->getSeccion();
        //     if ($asociacion->getEmpresa()) {
        //         $empresasPorSeccion[$seccion][] = $asociacion->getEmpresa();
        //     }
        //     if ($asociacion->getCentro()) {
        //         $centrosPorSeccion[$seccion][] = $asociacion->getCentro();
        //     }
        // }

        // dump($asociaciones);
        // dump($empresasPorSeccion);
        // dump($centrosPorSeccion);
        // die;


        // $form = $this->createForm(ParteDiarioType::class, $parteDiario, [
        //     'empresasPorSeccion' => $empresasPorSeccion,
        //     'centrosPorSeccion' => $centrosPorSeccion,
        // ]);

        $form = $this->createForm(ParteDiarioType::class, $parteDiario);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($parteDiario);
            $entityManager->flush();

            return $this->redirectToRoute('app_parte_diario_index');
        }

        return $this->render('parte_diario/new.html.twig', [
            'form' => $form->createView(),
            'empresa' => $empresa,
        ]);
    }


    #[Route('/{id}', name: 'app_parte_diario_show', methods: ['GET'])]
    public function show(ParteDiario $parteDiario): Response
    {
        return $this->render('parte_diario/show.html.twig', [
            'parte_diario' => $parteDiario,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_parte_diario_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ParteDiario $parteDiario, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ParteDiarioType::class, $parteDiario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_parte_diario_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('parte_diario/edit.html.twig', [
            'parte_diario' => $parteDiario,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_parte_diario_delete', methods: ['POST'])]
    public function delete(Request $request, ParteDiario $parteDiario, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $parteDiario->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($parteDiario);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_parte_diario_index', [], Response::HTTP_SEE_OTHER);
    }
}
