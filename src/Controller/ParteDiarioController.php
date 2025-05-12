<?php

namespace App\Controller;

use App\Entity\Centro;
use App\Entity\CentroPeces;
use App\Entity\EntidadPeces;
use App\Entity\ParteDiario;
use App\Entity\Peces;
use App\Entity\User;
use App\Form\ParteDiarioType;
use App\Repository\CentroRepository;
use App\Repository\EmpresaRepository;
use App\Repository\EntidadPecesRepository;
use App\Repository\EntidadRepository;
use App\Repository\ParteDiarioRepository;
use App\Repository\UserRepository;
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
    public function new(Request $request,EntidadPecesRepository $entidadPecesRepository, UserRepository $userRepository, EmpresaRepository $empresaRepository, CentroRepository $centroRepository, EntityManagerInterface $entityManager): Response
    {
        // 1. Usuario autenticado
        // $user = $this->getUser();
        $user = $userRepository->findOneBy(['username' => 'admin']);

        // 2. Obtener la entidad del usuario
        $empresa = $user->getEmpresa();

        // 3. Obtener los centros de esa entidad
        $entidad = $entidadPecesRepository->findOneBy(['nombre' => $empresa->getName()]);
        $centros = $centroRepository->findBy(['empresa' => $empresa]);

        // 4. Crear el objeto ParteDiario
        $parteDiario = new ParteDiario();
        // 5. Crear el subformulario Peces manualmente
        $peces = new Peces();

        // Crear la entidadPeces
        $entidadPeces = $entidad;

        // Por cada centro, crear un CentroPeces
        foreach ($centros as $centro) {
            $centroPeces = new CentroPeces();
            $centroPeces->setNombre($centro->getName()); // nombre del centro fijo
            $entidadPeces->addCentro($centroPeces); // Asignar el centroPeces a la entidadPeces
        }

        // Asignar la entidadPeces al objeto Peces
        $peces->addEntidade($entidadPeces); // Agregar la entidadPeces a Peces

        // Asignar Peces al ParteDiario
        $parteDiario->setPeces($peces); // Asociar Peces al ParteDiario



        // 6. Crear el formulario para el ParteDiario
        $form = $this->createForm(ParteDiarioType::class, $parteDiario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($parteDiario);
            $entityManager->flush();

            return $this->redirectToRoute('app_parte_diario_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('parte_diario/new.html.twig', [
            'form' => $form,
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
