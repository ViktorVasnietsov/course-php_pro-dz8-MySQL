<?php
namespace Viktor\PhpPro\Shortener\Interfaces;
use InvalidArgumentException;
use Viktor\PhpPro\Shortener\Exceptions\UrlNotFoundException;

interface IUrlValidator
{
    /**
     * @param string $url
     * @throws InvalidArgumentException
     * @return bool
     */
    public function validateUrl(string $url): bool;

    /**
     * @param string $url
     * @throws UrlNotFoundException
     * @return bool
     */
    public function checkRealUrl(string $url): bool;
}