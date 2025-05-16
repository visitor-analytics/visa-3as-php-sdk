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
use Visa\Subscriptions\IntpcSubscriptionApi;
use Visa\Subscriptions\WebsiteSubscriptionApi;

class VisitorAnalytics
{
    public AuthUtils $auth;
    public PackagesApi $packages;
    public WebsitesApi $websites;
    public IntpcsApi $intpcs;
    public WebsiteSubscriptionApi $websiteSubscription;
    public IntpcSubscriptionApi $intpcSubscription;
    
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
        $this->websiteSubscription = new WebsiteSubscriptionApi($this->httpClient);
        $this->intpcSubscription = new IntpcSubscriptionApi($this->httpClient);
    }

    public function package($id): PackageApi
    {
        return $this->package->setPackageId($id);
    }

    public function intpc($intpcId): IntpcApi
    {
        return $this->intpc->setIntpcId($intpcId);
    }

    public function website($intpWebsiteId): WebsiteApi
    {
        return $this->website->setIntpWebsiteId($intpWebsiteId);
    }
}