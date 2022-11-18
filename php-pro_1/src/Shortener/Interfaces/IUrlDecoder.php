<?php
namespace Viktor\PhpPro\Shortener\Interfaces;
use InvalidArgumentException;
interface IUrlDecoder
{
    /**
     * @param string $code
     * @throws InvalidArgumentException
     * @return string
     */
    public function decode(string $code): string;
}