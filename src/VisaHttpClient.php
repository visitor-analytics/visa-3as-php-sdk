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

    /**
     * @throws GuzzleException
     */
    public function post(string $path, array $payload): Response
    {
        return new Response($this->http->post($path, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->accessToken->getValue(),
                'Content-Type'        => 'application/json',
            ],
            'body' => json_encode($payload)
        ]));
    }

    /**
     * @param string $path
     * @param array $payload
     * @return Response
     * @throws GuzzleException
     */
    public function put(string $path, array $payload): Response
    {
        return new Response($this->http->put($path, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->accessToken->getValue(),
                'Content-Type'        => 'application/json',
            ],
            'body' => json_encode($payload)
        ]));
    }

    /**
     * @param string $path
     * @param array $payload
     * @return Response
     * @throws GuzzleException
     */
    public function patch(string $path, array $payload): Response
    {
        return new Response($this->http->patch($path, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->accessToken->getValue(),
                'Content-Type'        => 'application/json',
            ],
            'body' => json_encode($payload)
        ]));
    }

    /**
     * @throws GuzzleException
     */
    public function delete(string $path): Response
    {
        return new Response($this->http->delete($path, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->accessToken->getValue()
            ]
        ]));
    }
}
