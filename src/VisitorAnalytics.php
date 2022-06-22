<?php

declare(strict_types=1);

namespace Visa;

use Visa\Clients\ClientApi;
use Visa\Clients\ClientsApi;
use Visa\Packages\PackagesApi;
use Visa\TokenSigning\AccessTokenFactory;

class VisitorAnalytics
{
    private VisaHttpClient $httpClient;

    private PackagesApi $packagesApi;

    private ClientsApi $clientsApi;

    private ClientApi $clientApi;

    /**
     * @throws \Exception
     */
    public function __construct(array $params)
    {
        $this->httpClient = new VisaHttpClient([
            // http
            'host' => 'http://localhost:8080',
            'accessToken' => AccessTokenFactory::getAccessToken(
                'RS256',
                $params['company'],
                'dev'
            ),
        ]);

        $this->packagesApi = new PackagesApi($this->httpClient);
        $this->clientsApi = new ClientsApi($this->httpClient);
        $this->clientApi = new ClientApi($this->httpClient);
    }

    public function packages(): PackagesApi
    {
        return $this->packagesApi;
    }

    public function clients(): ClientsApi
    {
        return $this->clientsApi;
    }

    public function client($id): ClientApi
    {
        return $this->clientApi->setClientId($id);
    }
}
