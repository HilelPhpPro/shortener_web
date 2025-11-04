<?php

namespace Hillel\Shortener\ValueObjects;

use function str_replace;

class UrlCodePair
{
    /**
     * @param string $code
     * @param string $url
     */
    public function __construct(public string $code {
        get {
            return $this->code;
        }
    }, public string $url {
        get {
            return $this->url;
        }
    }
    ) {}

}
