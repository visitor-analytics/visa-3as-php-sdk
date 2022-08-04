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
use Visa\Utils\UtilsApi;
use Visa\Websites\WebsiteApi;
use Visa\Websites\WebsitesApi;

class VisitorAnalytics
{
    public const DASHBOARD_URL = '';

    public UtilsApi $utils;
    public PackagesApi $packages;
    public WebsitesApi $websites;
    public CustomersApi $customers;
    public NotificationsApi $notifications;

    private PackageApi $packageApi;
    private WebsiteApi $websiteApi;
    private CustomerApi $customerApi;
    private VisaHttpClient $httpClient;

    /**
     * @throws \Exception
     */
    public function __construct(array $params)
    {
        $this->validateSetup($params);

        $this->utils = new UtilsApi($params['intp'], $params['env']);

        $this->httpClient = new VisaHttpClient([
            // http
            'env' => $params['env'],
            'accessToken' => $this->utils->auth->generateINTPAccessToken(),
        ]);

        $this->packageApi = new PackageApi($this->httpClient);
        $this->packages = new PackagesApi($this->httpClient);
        $this->customerApi = new CustomerApi($this->httpClient);
        $this->customers = new CustomersApi($this->httpClient);
        $this->websiteApi = new WebsiteApi($this->httpClient);
        $this->websites = new WebsitesApi($this->httpClient);
        $this->notifications = new NotificationsApi($this->httpClient);
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

    public function package($id): PackageApi
    {
        return $this->packageApi->setPackageId($id);
    }

    public function customer($externalId): CustomerApi
    {
        return $this->customerApi->setCustomerExternalId($externalId);
    }

    public function website($externalId): WebsiteApi
    {
        return $this->websiteApi->setExternalId($externalId);
    }
}
