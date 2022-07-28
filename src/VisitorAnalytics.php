<?php

declare(strict_types=1);

namespace Visa;

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator;
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
    const API_GATEWAY_URL = 'http://94.130.27.191:9090';
    const DASHBOARD_URL = '';

    private array $intp = [];

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
        $this->validateIntp($params['intp']);

        $this->intp = $params['intp'];

        $this->httpClient = new VisaHttpClient([
            // http
            'host' => self::API_GATEWAY_URL,
            'accessToken' => AccessTokenFactory::getAccessToken(
                [
                    'alg' => 'RS256',
                    'kid' => $this->intp['id'],
                    'jwtClaims' => [
                        'sub' => $this->intp['domain'],
                        'role' => AccessTokenFactory::ROLE_INTP,
                    ],
                    'env' => 'dev',
                    'privateKey' => $this->intp['privateKey']
                ]
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

    private function validateIntp(array $intp): void
    {
        $intpValidationSchema = Validator::arrayType()
            ->key('id', Validator::stringType()->uuid(4))
            ->key('domain', Validator::stringType()->domain())
            ->key('privateKey', Validator::stringType());

        try {
            $intpValidationSchema->assert($intp);
        } catch (NestedValidationException $exception) {
            throw new \Exception(json_encode($exception->getMessages()));
        }
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

    public function dashboardIFrameUrl(): string
    {
        $intpcAccessToken = AccessTokenFactory::getAccessToken([
            'alg' => 'RS256',
            'kid' => $this->intp['id'],
            'jwtClaims' => [
                'sub' => $this->intp['domain'],
                'role' => AccessTokenFactory::ROLE_INTPC,
            ],
            'env' => 'dev',
            'privateKey' => $this->intp['privateKey']
        ])->getValue();

        return self::DASHBOARD_URL . '?intpc_token=' . $intpcAccessToken;
    }
}
