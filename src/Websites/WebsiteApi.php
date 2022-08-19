<?php

declare(strict_types=1);

namespace Visa\Websites;

use Visa\HydratorInterface;
use Visa\VisaHttpClient;

class WebsiteApi
{
    private string $intpWebsiteId;

    private VisaHttpClient $visaHttpClient;
    private HydratorInterface $websiteHydrator;

    public function __construct(VisaHttpClient $visaHttpClient)
    {
        $this->visaHttpClient = $visaHttpClient;
        $this->websiteHydrator = new WebsiteHydrator();
    }

    public function setIntpWebsiteId(string $intpWebsiteId): WebsiteApi
    {
        $this->intpWebsiteId = $intpWebsiteId;

        return $this;
    }

    public function delete(): Website
    {
        if (!$this->intpWebsiteId) {
            throw new \Exception('Website external id not set.');
        }

        $response = $this->visaHttpClient->delete('/v2/3as/websites/' . $this->intpWebsiteId);

        return $this->websiteHydrator->hydrateObject($response->getPayload());
    }
}
