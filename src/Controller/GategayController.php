<?php

namespace App\Controller;

use App\Entity\Osde;
use App\Repository\OsdeRepository;
use App\Service\CubadebateService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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

    #[Route('/noticias', name: 'app_noticias')]
    public function cubadebate(CubadebateService $cubadebate): Response
    {
                return $this->render('cuabadebate.html.twig', [
                    'content' => $cubadebate->obtenerContenidoNoticias(),
                ]);
       
    }
}
