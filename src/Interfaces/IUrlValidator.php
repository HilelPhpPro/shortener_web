<?php

namespace Hillel\Shortener\Interfaces;

use InvalidArgumentException;
interface IUrlValidator
{
    /**
     * @param string $url
     * @throws InvalidArgumentException
     * @return bool
     */
    public function validateUrl(string $url): true;

    /**
     * @param string $url
     * @throws InvalidArgumentException
     * @return bool
     */
    public function checkRealUrl(string $url): true;
}
