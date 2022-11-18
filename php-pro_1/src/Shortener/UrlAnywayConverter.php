<?php

namespace Viktor\PhpPro\Shortener;

class UrlAnywayConverter extends UrlConvertor
{
    /**
     * @param string $url
     * @return string
     */
    public function encode(string $url): string
    {
        $this->validateUrl($url);
        return $this->generateAndSaveCode($url);
    }
}