<?php

namespace App\Controller;

use App\Entity\File;
use App\Entity\User;
use App\Form\ChangePasswordType;
use App\Form\UserType;
use App\Repository\FileRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Random\Engine\Secure;
use Random\Randomizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/user')]
final class UserController extends AbstractController
{
    #[Route(name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository, EntityManagerInterface $entityManager, FileRepository $fileRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        $passwordRandom = $this->generarContrasena(8);
        $user->setPassword($passwordRandom);
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plainPassword = $form->get('password')->getData();
            $hashedPassword = $passwordHasher->hashPassword($user, $plainPassword);
            $user->setPassword($hashedPassword);

            if ($form->get('centro_coordinacion')->getData()) {
                $user->setRoles(['ROLE_CENTRO_COORDINACION']);
                $user->setEmpresa(null);
                $user->setEspecialidad(null);
            } elseif ($form->get('empresa')->getData()) {
                $user->setEmpresa($form->get('empresa')->getData());
                $user->setRoles(['ROLE_EMPRESA']);
            } elseif ($form->get('especialidad')->getData()) {
                $user->setEspecialidad($form->get('especialidad')->getData());
                $user->setRoles(['ROLE_ESPECIALIDAD']);
            } else {
                $form->addError(new FormError('Debe seleccionar una opcion.'));
            }

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_user_index');
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function changePassword(Request $request,User $user, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ChangePasswordType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $currentPassword = $form->get('currentPassword')->getData();
            if (!$passwordHasher->isPasswordValid($user, $currentPassword)) {
                $form->get('currentPassword')->addError(new \Symfony\Component\Form\FormError('La contraseña actual es incorrecta.'));
            } else {
                $newPassword = $form->get('newPassword')->getData();
                $user->setPassword($passwordHasher->hashPassword($user, $newPassword));
                $entityManager->flush();

                $this->addFlash('success', 'Contraseña actualizada correctamente.');
                return $this->redirectToRoute('app_home');
            }
        }

        return $this->render('user/edit.html.twig', [
            'form' => $form,
        ]);
    }



    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }

    private function generarContrasena($longitud) {
        // Caracteres permitidos
        $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789*/.';
        $contrasena = '';
        $maxIndex = strlen($caracteres) - 1;

        for ($i = 0; $i < $longitud; $i++) {
            $indice = random_int(0, $maxIndex);
            $contrasena .= $caracteres[$indice];
        }

        return $contrasena;
    }
}
