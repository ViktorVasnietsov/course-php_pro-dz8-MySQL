<?php

namespace Viktor\PhpPro\Core\Interfaces;

interface ISingleton
{
    public static function getInstance(): self;
}
