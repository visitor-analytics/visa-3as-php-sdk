<?php

namespace Visa\Websites;

use Visa\HydratorInterface;
use Visa\VisaHttpClient;

class WebsitesApi
{
    private VisaHttpClient $httpClient;
    private HydratorInterface $websiteHydrator;

    public function __construct(VisaHttpClient $httpClient)
    {
        $this->httpClient = $httpClient;

        $this->websiteHydrator = new WebsiteHydrator();
    }

    public function list(): array
    {
        $response = $this->httpClient->get('/v2/3as/websites');

        return $this->websiteHydrator->hydrateObjectArray($response->getPayload());
    }

    public function getById($id): Website
    {
        $response = $this->httpClient->get('/v2/3as/websites/' . $id);

        return $this->websiteHydrator->hydrateObject($response->getPayload());
    }
}
