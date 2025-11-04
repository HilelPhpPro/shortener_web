<?php

namespace Hillel\Shortener\Interfaces;

use InvalidArgumentException;

interface IUrlEncoder
{
    /**
     * @throws InvalidArgumentException
     */
    public function encode(string $url): string;
}
