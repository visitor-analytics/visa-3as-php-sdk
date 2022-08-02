<?php

declare(strict_types=1);

namespace Visa;

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator;
use Visa\Customers\CustomerApi;
use Visa\Customers\CustomersApi;
use Visa\Notifications\NotificationsApi;
use Visa\Packages\PackageApi;
use Visa\Packages\PackagesApi;
use Visa\TokenSigning\AccessTokenFactory;
use Visa\Websites\WebsiteApi;
use Visa\Websites\WebsitesApi;

class VisitorAnalytics
{
    public const DASHBOARD_URL = '';

    private string $env;
    private array $intp = [];

    private VisaHttpClient $httpClient;

    private NotificationsApi $notificationsApi;

    private PackagesApi $packagesApi;

    private PackageApi $packageApi;

    private CustomersApi $customersApi;

    private CustomerApi $customerApi;

    private WebsitesApi $websitesApi;

    private WebsiteApi $websiteApi;

    /**
     * @throws \Exception
     */
    public function __construct(array $params)
    {
        $this->validateSetup($params);

        $this->intp = $params['intp'];
        $this->env = $params['env'];

        $this->httpClient = new VisaHttpClient([
            // http
            'accessToken' => AccessTokenFactory::getAccessToken(
                [
                    'alg' => 'RS256',
                    'kid' => $this->intp['id'],
                    'jwtClaims' => [
                        'sub' => $this->intp['domain'],
                        'role' => AccessTokenFactory::ROLE_INTP,
                    ],
                    'env' => $this->env,
                    'privateKey' => $this->intp['privateKey']
                ]
            ),
            'env' => $this->env
        ]);

        $this->notificationsApi = new NotificationsApi($this->httpClient);
        $this->packagesApi = new PackagesApi($this->httpClient);
        $this->packageApi = new PackageApi($this->httpClient);
        $this->customersApi = new CustomersApi($this->httpClient);
        $this->customerApi = new CustomerApi($this->httpClient);
        $this->websitesApi = new WebsitesApi($this->httpClient);
        $this->websiteApi = new WebsiteApi($this->httpClient);
    }

    private function validateSetup(array $params): void
    {
        $skdSetupValidationSchema = Validator::arrayType()
            ->key('intp', Validator::arrayType()
                ->key('id', Validator::stringType()->uuid(4))
                ->key('domain', Validator::stringType()->domain())
                ->key('privateKey', Validator::stringType()))
            ->key('env', Validator::oneOf(Validator::equals('dev'), Validator::equals('prod')));

        try {
            $skdSetupValidationSchema->assert($params);
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

    public function customers(): CustomersApi
    {
        return $this->customersApi;
    }

    public function customer($externalId): CustomerApi
    {
        return $this->customerApi->setCustomerExternalId($externalId);
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
