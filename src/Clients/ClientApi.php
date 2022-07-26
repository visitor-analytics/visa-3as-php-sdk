<?php

declare(strict_types=1);

namespace Visa\Clients;

use GuzzleHttp\Exception\GuzzleException;
use Visa\HydratorInterface;
use Visa\VisaHttpClient;
use Visa\Websites\WebsiteHydrator;

class ClientApi
{
    private string $externalClientId;

    private VisaHttpClient $httpClient;
    private HydratorInterface $websiteHydrator;
    private HydratorInterface $clientHydrator;

    public function __construct(VisaHttpClient $httpClient)
    {
        $this->httpClient = $httpClient;

        $this->websiteHydrator = new WebsiteHydrator();
        $this->clientHydrator = new ClientHydrator();
    }

    public function setClientExternalId(string $externalId): ClientApi
    {
        $this->externalClientId = $externalId;

        return $this;
    }

    /**
     * @throws GuzzleException
     * @throws \Exception
     */
    public function listWebsites($pagination = [ 'page' => 0, 'pageSize' => 10]): array
    {
        if (!$this->externalClientId) {
            throw new \Exception('Client id not specified.');
        }

        $response = $this->httpClient->get('/v2/3as/websites?externalClientId=' . $this->externalClientId . '&page=' . $pagination['page'] . '&pageSize=' . $pagination['pageSize']);

        return [
            'metadata' => $response->getMetadata(),
            'items' => $this->websiteHydrator->hydrateObjectArray($response->getPayload())
        ];
    }

    public function delete(): Client
    {
        $response = $this->httpClient->delete('/v2/3as/clients/' . $this->externalClientId);

        return $this->clientHydrator->hydrateObject($response->getPayload());
    }
}
