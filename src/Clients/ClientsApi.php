<?php

declare(strict_types=1);

namespace Visa\Clients;

use Visa\VisaHttpClient;

class ClientsApi
{
    private VisaHttpClient $httpClient;
    private ClientHydrator $hydrator;

    public function __construct(VisaHttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
        $this->hydrator = new ClientHydrator();
    }

    public function list(): array
    {
        $response = $this->httpClient->get('/v2/3as/clients');

        return $this->hydrator->hydrateObjectArray($response->getPayload());
    }

    public function getById($id): Client
    {
        $response = $this->httpClient->get('/v2/3as/clients/' . $id);

        return $this->hydrator->hydrateObject($response->getPayload());
    }
}
