<?php

namespace Hillel\Shortener\Interfaces;

use Hillel\Shortener\ValueObjects\UrlCodePair;
use Hillel\Shortener\Exceptions\DataNotFoundException;

interface ICodeRepository
{
    /**
     * @param UrlCodePair $urlCodePair
     * @return bool
     */
    public function saveEntity(UrlCodePair $urlCodePair): bool;

    /**
     * @param string $code
     * @return bool
     */
    public function codeIsset(string $code): bool;

    /**
     * @param string $code
     * @throws DataNotFoundException
     * @return string url
     */
    public function getUrlByCode(string $code): string;

    /**
     * @param string $url
     * @throws DataNotFoundException
     * @return string code
     */
    public function getCodeByUrl(string $url): string;

    public function getAll(): array;

}
