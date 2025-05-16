<?php

declare(strict_types=1);

namespace Visa;

use Visa\Intpcs\IntpcApi;
use Visa\Intpcs\IntpcsApi;
use Visa\Packages\PackageApi;
use Visa\Packages\PackagesApi;
use Visa\Utils\AuthUtils;
use Visa\Utils\IFrameUtils;
use Visa\Websites\WebsiteApi;
use Visa\Websites\WebsitesApi;
use Visa\Subscriptions\IntpcSubscriptionsApi;
use Visa\Subscriptions\WebsiteSubscriptionsApi;

class VisitorAnalytics
{
    public AuthUtils $auth;
    public PackagesApi $packages;
    public WebsitesApi $websites;
    public IntpcsApi $intpcs;
    public WebsiteSubscriptionsApi $websiteSubscription;
    public IntpcSubscriptionsApi $intpcSubscription;
    
    private PackageApi $package;
    private WebsiteApi $website;
    private IntpcApi $intpc;
    private VisaHttpClient $httpClient;

    /**
     * @throws \Exception
     */
    public function __construct(array $params)
    {
        $this->auth = new AuthUtils($params['intp']);

        $this->httpClient = new VisaHttpClient([
            // http
            'env' => $params['env'],
            'accessToken' => $this->auth->generateINTPAccessToken(),
        ]);

        $this->package = new PackageApi($this->httpClient);
        $this->packages = new PackagesApi($this->httpClient);
        $this->intpc = new IntpcApi($this->httpClient, new IFrameUtils($this->auth, $params['env']));
        $this->intpcs = new IntpcsApi($this->httpClient);
        $this->website = new WebsiteApi($this->httpClient);
        $this->websites = new WebsitesApi($this->httpClient);
        $this->websiteSubscription = new WebsiteSubscriptionsApi($this->httpClient);
        $this->intpcSubscription = new IntpcSubscriptionsApi($this->httpClient);
    }

    public function package($id): PackageApi
    {
        return $this->package->setPackageId($id);
    }

    public function customer($intpcId): IntpcApi
    {
        return $this->intpc->setIntpcId($intpcId);
    }

    public function website($intpWebsiteId): WebsiteApi
    {
        return $this->website->setIntpWebsiteId($intpWebsiteId);
    }
}