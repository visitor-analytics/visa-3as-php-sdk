<?php

declare(strict_types=1);

namespace Visa;

use Exception;
use GuzzleHttp\Exception\GuzzleException;

class VisaHttpClient
{
    public const DEV_API_GATEWAY_URI = 'https://api-gateway.va-endpoint.com';
    public const STAGE_API_GATEWAY_URI = 'https://stage-api-gateway.va-endpoint.com';
    public const PRODUCTION_API_GATEWAY_URI = 'https://api-gateway.visitor-analytics.io';

    // http client
    private $http;
    // visa gateway
    private string $apiGatewayBaseUri;
    // authentication
    private string $accessToken;

    /**
     * @throws \Exception
     */
    public function __construct(array $params)
    {
        $this->accessToken = $params['accessToken'];

        switch ($params['env']) {
            case 'dev':
                $this->apiGatewayBaseUri = self::DEV_API_GATEWAY_URI;
                break;
            case 'stage':
                $this->apiGatewayBaseUri = self::STAGE_API_GATEWAY_URI;
                break;
            case 'production':
                $this->apiGatewayBaseUri = self::PRODUCTION_API_GATEWAY_URI;
                break;
            default:
                throw new Exception("unsupported sdk env");
                break;
        }

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
        return new Response($this->http->get($this->apiGatewayBaseUri . $path, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->accessToken,
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
                'Authorization' => 'Bearer ' . $this->accessToken,
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
                'Authorization' => 'Bearer ' . $this->accessToken,
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
                'Authorization' => 'Bearer ' . $this->accessToken,
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
                'Authorization' => 'Bearer ' . $this->accessToken
            ]
        ]));
    }
}
