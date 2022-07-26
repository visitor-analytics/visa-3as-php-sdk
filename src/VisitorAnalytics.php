<?php

declare(strict_types=1);

namespace Visa;

use Visa\Clients\ClientApi;
use Visa\Clients\ClientsApi;
use Visa\Notifications\NotificationsApi;
use Visa\Packages\PackageApi;
use Visa\Packages\PackagesApi;
use Visa\TokenSigning\AccessTokenFactory;
use Visa\Websites\WebsiteApi;
use Visa\Websites\WebsitesApi;

class VisitorAnalytics
{
    private VisaHttpClient $httpClient;

    private NotificationsApi $notificationsApi;

    private PackagesApi $packagesApi;

    private PackageApi $packageApi;

    private ClientsApi $clientsApi;

    private ClientApi $clientApi;

    private WebsitesApi $websitesApi;

    private WebsiteApi $websiteApi;

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
        $this->packageApi = new PackageApi($this->httpClient);
        $this->clientsApi = new ClientsApi($this->httpClient);
        $this->clientApi = new ClientApi($this->httpClient);
        $this->websitesApi = new WebsitesApi($this->httpClient);
        $this->websiteApi = new WebsiteApi($this->httpClient);
    }

    public function notifications(): NotificationsApi
    {
        return $this->notificationsApi;
    }

    public function packages(): PackagesApi
    {
        return $this->packagesApi;
    }

    public function package($id): PackageApi
    {
        return $this->packageApi->setPackageId($id);
    }

    public function clients(): ClientsApi
    {
        return $this->clientsApi;
    }

    public function client($externalId): ClientApi
    {
        return $this->clientApi->setClientExternalId($externalId);
    }

    public function websites(): WebsitesApi
    {
        return $this->websitesApi;
    }

    public function website($externalId): WebsiteApi
    {
        return $this->websiteApi->setExternalId($externalId);
    }
}
