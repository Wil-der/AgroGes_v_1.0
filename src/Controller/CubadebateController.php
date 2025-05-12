<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\CubadebateService;

class CubadebateController extends AbstractController
{
    #[Route('/cubadebate', name: 'cubadebate')]
    public function index(CubadebateService $cubadebate): Response
    {
        $url = 'http://www.cubadebate.cu/categoria/noticias/';

        $html = $this->getHtmlFromUrl($url);

        if (!$html) {
            return $this->render('cubadebate.html.twig', [
            
                'content' => null,
            ]);        }

        $archiveContent = $this->extractArchiveContent($html);

        if (!$archiveContent) {
            return $this->render('cubadebate.html.twig', [
            
                'content' => null,
            ]);        }

        return $this->render('cubadebate.html.twig', [
            
            'content' => $archiveContent,
        ]);
    }

    private function getHtmlFromUrl(string $url): ?string
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $html = curl_exec($ch);
        curl_close($ch);

        return $html ?: null;
    }

    private function extractArchiveContent(string $html): ?string
    {
        libxml_use_internal_errors(true);
        $doc = new \DOMDocument();
        $doc->loadHTML($html);
        libxml_clear_errors();

        $xpath = new \DOMXPath($doc);
        $archiveDiv = $xpath->query("//div[@id='archive']")->item(0);

        if (!$archiveDiv) {
            return null;
        }

        return $doc->saveHTML($archiveDiv);
    }
}
