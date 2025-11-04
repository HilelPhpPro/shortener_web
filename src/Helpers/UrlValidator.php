<?php

namespace Hillel\Shortener\Helpers;

use Hillel\Shortener\Interfaces\IUrlValidator;
use InvalidArgumentException;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class UrlValidator implements IUrlValidator
{
    public function __construct(protected HttpClientInterface $client)
    {
    }


    /**
     * @inheritDoc
     */
    public function validateUrl(string $url): true
    {
        if (empty($url)
            || !filter_var($url, FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException('Url is broken');
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function checkRealUrl(string $url): true
    {
        $allowCodes = [
            200, 201, 301, 302
        ];
        try {
            $response = $this->client->request('GET', $url);
            return (!empty($response->getStatusCode()) && in_array($response->getStatusCode(), $allowCodes));
        } catch (TransportExceptionInterface $exception) {
            throw new InvalidArgumentException($exception->getMessage(), $exception->getCode());
        }

    }
}
