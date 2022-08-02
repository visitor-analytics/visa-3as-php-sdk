<?php

declare(strict_types=1);

namespace Visa;

use GuzzleHttp\Exception\GuzzleException;
use Visa\TokenSigning\AccessToken;

class VisaHttpClient
{
    public const DEV_API_GATEWAY_URI = 'http://94.130.27.191:9090';
    public const PROD_API_GATEWAY_URI = '';

    // http client
    private $http;
    // visa gateway
    private string $apiGatewayBaseUri;
    // sdk version
    private string $version = 'development';
    // authentication
    private AccessToken $accessToken;

    /**
     * @throws \Exception
     */
    public function __construct(array $params)
    {
        $this->accessToken = $params['accessToken'];

        $this->apiGatewayBaseUri = $params['env'] === 'dev' ? self::DEV_API_GATEWAY_URI : self::PROD_API_GATEWAY_URI;

        $this->http = new \GuzzleHttp\Client([
            'base_uri' => $this->apiGatewayBaseUri,
            'timeout' => 3.0
        ]);
    }

    /**
     * @throws GuzzleException
     * @throws \Exception
     */
    public function get(string $path): Response
    {
        print_r($this->accessToken->getValue());

        return new Response($this->http->get($this->apiGatewayBaseUri . $path, [
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
