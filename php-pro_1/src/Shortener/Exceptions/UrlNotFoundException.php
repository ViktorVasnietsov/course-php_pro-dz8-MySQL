<?php

namespace Viktor\PhpPro\Shortener\Exceptions;
class UrlNotFoundException extends DataNotFoundException
{
    protected $message = 'This Url does not exist';
}