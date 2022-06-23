<?php

declare(strict_types=1);

namespace Visa;

use Visa\Clients\ClientApi;
use Visa\Clients\ClientsApi;
use Visa\Notifications\NotificationsApi;
use Visa\Packages\PackagesApi;
use Visa\TokenSigning\AccessTokenFactory;

class VisitorAnalytics
{
    private VisaHttpClient $httpClient;

    private NotificationsApi $notificationsApi;

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

        $this->notificationsApi = new NotificationsApi($this->httpClient);
        $this->packagesApi = new PackagesApi($this->httpClient);
        $this->clientsApi = new ClientsApi($this->httpClient);
        $this->clientApi = new ClientApi($this->httpClient);
    }

    public function notifications(): NotificationsApi
    {
        return $this->notificationsApi;
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
