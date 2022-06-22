<?php

declare(strict_types=1);

namespace Visa;

use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use Visa\TokenSigning\AccessToken;

class VisaHttpClient
{
    // http client
    private $http;
    // visa gateway
    private string $host;
    // sdk version
    private string $version = 'development';
    // authentication
    private AccessToken $accessToken;

    /**
     * @throws \Exception
     */
    public function __construct(array $params)
    {
        $this->host = $params['host'];
        $this->accessToken = $params['accessToken'];

        $this->http = new \GuzzleHttp\Client([
            'base_uri' => $params['host'],
            'timeout' => 3.0
        ]);
    }

    /**
     * @throws GuzzleException
     * @throws \Exception
     */
    public function get(string $path): Response
    {
        return new Response($this->http->get($this->host . $path, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->accessToken->getValue(),
                'Accept'        => 'application/json',
            ]
        ]));
    }
}
