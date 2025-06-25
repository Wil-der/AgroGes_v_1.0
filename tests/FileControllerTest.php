<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Entity\Especialidad;
use App\Entity\User;

class FileControllerTest extends WebTestCase
{
    private $client;
    private $entityManager;
    private static $especialidad;
    private static $testUser;

    protected function setUp(): void
    {
        $this->client = static::createClient();

        // Usar static::getContainer() para evitar problemas con kernel boot
        $this->entityManager = static::getContainer()->get('doctrine')->getManager();

        if (!self::$especialidad) {
            $especialidadRepository = $this->entityManager->getRepository(Especialidad::class);
            self::$especialidad = $especialidadRepository->findOneBy([]);
            if (!self::$especialidad) {
                self::$especialidad = new Especialidad();
                self::$especialidad->setName('Especialidad de prueba');
                $this->entityManager->persist(self::$especialidad);
                $this->entityManager->flush();
            }
        }

        if (!self::$testUser) {
            $userRepository = $this->entityManager->getRepository(User::class);
            self::$testUser = $userRepository->findOneBy(['especialidad' => self::$especialidad]);
            if (!self::$testUser) {
                self::$testUser = new User();
                self::$testUser->setUsername('testuser@example.com');
                self::$testUser->setPassword('no importa aquí');
                self::$testUser->setEspecialidad(self::$especialidad);
                // Agrega otros campos obligatorios para tu entidad User, por ejemplo roles, username, etc.
                $this->entityManager->persist(self::$testUser);
                $this->entityManager->flush();
            }
        }
    }

    public function testSubirArchivo()
    {
        $this->client->loginUser(self::$testUser);

        $archivoTemporal = tempnam(sys_get_temp_dir(), 'test');
        file_put_contents($archivoTemporal, 'contenido prueba');

        $uploadedFile = new UploadedFile(
            $archivoTemporal,
            'prueba.txt',
            'text/plain',
            null,
            true
        );

        $crawler = $this->client->request('GET', '/file/new');
        $this->assertResponseIsSuccessful();

        $form = $crawler->selectButton('Crear')->form();
        $form['file[name]'] = 'Archivo de prueba';
        $form['file[fileUpload]'] = $uploadedFile;

        $this->client->submit($form);

        $this->assertResponseRedirects();

        $this->client->followRedirect();
        $this->assertResponseIsSuccessful();
    }

    public function testDescargarArchivo()
    {
        $this->client->loginUser(self::$testUser);

        $file = $this->entityManager
            ->getRepository(\App\Entity\File::class)
            ->findOneBy(['especialidad' => self::$especialidad]);

        if (!$file) {
            $this->markTestSkipped('No hay archivos para probar la descarga');
        }

        $this->client->request('GET', '/file/download/' . $file->getId());

        $this->assertResponseIsSuccessful();

        $headers = $this->client->getResponse()->headers;
        $this->assertStringContainsString('attachment; filename=', $headers->get('Content-Disposition'));
        $this->assertNotEmpty($this->client->getResponse()->getContent());
    }

    protected function tearDown(): void
    {
        // No eliminamos nada para evitar problemas con entidades detached
        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null;
        $this->client = null;
    }
}
