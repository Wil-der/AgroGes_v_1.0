<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'app:create-admin-user',
    description: 'Crear un usuario administrador'
)]
class CreateAdminUserCommand extends Command
{
    private EntityManagerInterface $entityManager;
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->passwordHasher = $passwordHasher;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /** @var QuestionHelper $helper */
        $helper = $this->getHelper('question'); // Obtener el helper correctamente

        $output->writeln('Creando SuperAdministrador');

        // Pedir nombre de usuario
        $usernameQuestion = new Question('Nombre de usuario: ');
        $username = $helper->ask($input, $output, $usernameQuestion); // Usar el helper adecuado

        // Pedir contraseña
        $passwordQuestion = new Question('Contraseña: ');
        $passwordQuestion->setHidden(true);
        $passwordQuestion->setHiddenFallback(false); // Para ocultar la entrada de la contraseña
        $plainPassword = $helper->ask($input, $output, $passwordQuestion); // Usar el helper adecuado

        // Crear el usuario
        $user = new User();
        $user->setUsername($username);
        $user->setRoles(['ROLE_ADMIN']); // Rol de Administrador

        // Hashear la contraseña
        $hashedPassword = $this->passwordHasher->hashPassword($user, $plainPassword);
        $user->setPassword($hashedPassword);

        // Guardar en la base de datos
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $output->writeln('SuperAdministrador creado exitosamente.');

        return Command::SUCCESS;
    }
}
