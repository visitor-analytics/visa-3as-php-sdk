<?php

declare(strict_types=1);

namespace Visa;

use GuzzleHttp\Exception\GuzzleException;
use Visa\Hydrators\HydratorInterface;
use Visa\TokenSigning\AccessToken;
use Visa\TokenSigning\AccessTokenFactory;

class Client
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

        $this->http = new \GuzzleHttp\Client([
            'base_uri' => $params['host'],
            'timeout' => 3.0
        ]);

        $this->accessToken = AccessTokenFactory::getAccessToken('RS256', $params['company'], $this->version);
    }

    /**
     * @throws GuzzleException
     * @throws \Exception
     */
    public function get(string $path): array
    {
        $response = $this->http->get($this->host . $path, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->accessToken->getValue(),
                'Accept'        => 'application/json',
            ]
        ]);

        if ($response->getStatusCode() === 500) {
            throw new \Exception('Request Failed.');
        }

        return json_decode($response->getBody()->getContents(), true)['payload'];
    }
}
