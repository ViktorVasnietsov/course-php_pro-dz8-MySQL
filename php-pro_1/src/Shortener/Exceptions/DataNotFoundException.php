<?php

namespace Viktor\PhpPro\Shortener\Exceptions;

use Exception;

class DataNotFoundException extends Exception
{
    protected $message = 'Data not found';
}

