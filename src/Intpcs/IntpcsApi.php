<?php

declare(strict_types=1);

namespace Visa\Intpcs;

use Visa\VisaHttpClient;

class IntpcsApi
{
    private VisaHttpClient $httpClient;
    private IntpcHydrator $hydrator;

    public function __construct(VisaHttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
        $this->hydrator = new IntpcHydrator();
    }

    public function create(array $customer): Intpc
    {
        $response = $this->httpClient->post('/v2/3as/customers', $customer);
        
        return $this->hydrator->hydrateObject($response->getPayload());
    }

    public function list($pagination = ['page' => 0, 'pageSize' => 10]): array
    {
        $response = $this->httpClient->get("/v2/3as/customers?page=" . $pagination['page'] . '&pageSize=' . $pagination['pageSize']);

        return  [
            'metadata' => $response->getMetadata(),
            'items' => $this->hydrator->hydrateObjectArray($response->getPayload())
        ];
    }

    public function getByIntpCustomerId($intpCustomerId): Intpc
    {
        $response = $this->httpClient->get('/v2/3as/customers/' . $intpCustomerId);

        return $this->hydrator->hydrateObject($response->getPayload());
    }
}
