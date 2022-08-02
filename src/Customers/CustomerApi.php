<?php

declare(strict_types=1);

namespace Visa\Customers;

use GuzzleHttp\Exception\GuzzleException;
use Visa\HydratorInterface;
use Visa\VisaHttpClient;
use Visa\Websites\WebsiteHydrator;

class CustomerApi
{
    private string $externalCustomerId;

    private VisaHttpClient $httpClient;
    private HydratorInterface $websiteHydrator;
    private HydratorInterface $customerHydrator;

    public function __construct(VisaHttpClient $httpClient)
    {
        $this->httpClient = $httpClient;

        $this->websiteHydrator = new WebsiteHydrator();
        $this->customerHydrator = new CustomerHydrator();
    }

    public function setCustomerExternalId(string $externalId): CustomerApi
    {
        $this->externalCustomerId = $externalId;

        return $this;
    }

    /**
     * @throws GuzzleException
     * @throws \Exception
     */
    public function listWebsites($pagination = [ 'page' => 0, 'pageSize' => 10]): array
    {
        if (!$this->externalCustomerId) {
            throw new \Exception('Customer id not specified.');
        }

        $response = $this->httpClient->get('/v2/3as/websites?externalCustomerId=' . $this->externalCustomerId . '&page=' . $pagination['page'] . '&pageSize=' . $pagination['pageSize']);

        return [
            'metadata' => $response->getMetadata(),
            'items' => $this->websiteHydrator->hydrateObjectArray($response->getPayload())
        ];
    }

    public function delete(): Customer
    {
        $response = $this->httpClient->delete('/v2/3as/customers/' . $this->externalCustomerId);

        return $this->customerHydrator->hydrateObject($response->getPayload());
    }
}
