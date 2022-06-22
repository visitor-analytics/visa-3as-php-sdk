<?php

declare(strict_types=1);

namespace Visa\Clients;

use GuzzleHttp\Exception\GuzzleException;
use Visa\HydratorInterface;
use Visa\VisaHttpClient;
use Visa\Websites\WebsiteHydrator;

class ClientApi
{
    private string $baseUrl;
    private VisaHttpClient $httpClient;
    private HydratorInterface $websiteHydrator;

    public function __construct(VisaHttpClient $httpClient)
    {
        $this->httpClient = $httpClient;

        $this->websiteHydrator = new WebsiteHydrator();
    }

    public function setClientId(string $clientId): ClientApi
    {
        $this->baseUrl = '/v2/3as/clients/' . $clientId;

        return $this;
    }

    /**
     * @throws GuzzleException
     * @throws \Exception
     */
    public function listWebsites(): array
    {
        if (!$this->baseUrl) {
            throw new \Exception('Client id not specified.');
        }

        $response = $this->httpClient->get($this->baseUrl . '/websites');

        return $this->websiteHydrator->hydrateObjectArray($response->getPayload());
    }
}
