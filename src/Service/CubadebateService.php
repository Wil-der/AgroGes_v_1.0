<?php

namespace App\Service;

class CubadebateService
{
    public function obtenerContenidoNoticias(): ?string
    {
        $url = 'http://www.cubadebate.cu/categoria/noticias/';
        $html = $this->getHtmlFromUrl($url);

        if (!$html) {
            return null;
        }

        return $this->extractArchiveContent($html);
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

        return $archiveDiv ? $doc->saveHTML($archiveDiv) : null;
    }
}
