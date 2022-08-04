<?php

namespace Visa\Websites;

use Visa\HydratorInterface;
use Visa\VisaHttpClient;

class WebsiteApi
{
    private string $externalId;

    private VisaHttpClient $visaHttpClient;
    private HydratorInterface $websiteHydrator;

    public function __construct(VisaHttpClient $visaHttpClient)
    {
        $this->visaHttpClient = $visaHttpClient;
        $this->websiteHydrator = new WebsiteHydrator();
    }

    public function setExternalId(string $externalId): WebsiteApi
    {
        $this->externalId = $externalId;

        return $this;
    }

    public function delete(): Website
    {
        if (!$this->externalId) {
            throw new \Exception('Website external id not set.');
        }

        $response = $this->visaHttpClient->delete('/v2/3as/websites/' . $this->externalId);

        return $this->websiteHydrator->hydrateObject($response->getPayload());
    }
}
