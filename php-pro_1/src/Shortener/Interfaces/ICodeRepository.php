<?php
namespace Viktor\PhpPro\Shortener\Interfaces;
use Viktor\PhpPro\Shortener\Exceptions\DataNotFoundException;
use Viktor\PhpPro\Shortener\ValueObjects\UrlCodePair;


interface ICodeRepository
{
    /**
     * @param UrlCodePair $urlUrlCodePair
     * @return bool
     */
    public function saveEntity(UrlCodePair $urlUrlCodePair):bool;
    /**
     * @param string $code
     * @return bool
     */
    public function codeIsset(string $code):bool;

    /**
     * @param string $code
     * @throws DataNotFoundException
     * @return string url
     */

    public function getUrlByCode(string $code):string;

    /**
     * @param string $code
     * @throws DataNotFoundException
     * @return string code
     */
    //public function getUrlByCode(string $url):string;
}