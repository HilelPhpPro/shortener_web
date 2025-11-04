<?php

namespace Hillel\Shortener\Interfaces;

use InvalidArgumentException;

interface IUrlDecoder
{
    /**
     * @throws InvalidArgumentException
     */
    public function decode(string $code): string;
}
