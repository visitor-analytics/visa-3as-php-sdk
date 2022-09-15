<?php

declare(strict_types=1);

namespace Visa\Customers;

use GuzzleHttp\Exception\GuzzleException;
use Visa\HydratorInterface;
use Visa\Utils\IFrameUtils;
use Visa\VisaHttpClient;
use Visa\Websites\WebsiteHydrator;

class CustomerApi
{
    private string $intpCustomerId;

    private IFrameUtils $iframe;
    private VisaHttpClient $httpClient;
    private HydratorInterface $websiteHydrator;
    private HydratorInterface $customerHydrator;

    public function __construct(VisaHttpClient $httpClient, IFrameUtils $iframe)
    {
        $this->iframe = $iframe;
        $this->httpClient = $httpClient;

        $this->websiteHydrator = new WebsiteHydrator();
        $this->customerHydrator = new CustomerHydrator();
    }

    public function setIntpCustomerId(string $intpCustomerId): CustomerApi
    {
        $this->intpCustomerId = $intpCustomerId;

        return $this;
    }

    /**
     * @throws GuzzleException
     * @throws \Exception
     */
    public function listWebsites($pagination = [ 'page' => 0, 'pageSize' => 10]): array
    {
        if (!$this->intpCustomerId) {
            throw new \Exception('Customer id not specified.');
        }

        $response = $this->httpClient->get('/v2/3as/websites?externalCustomerId=' . $this->intpCustomerId . '&page=' . $pagination['page'] . '&pageSize=' . $pagination['pageSize']);

        return [
            'metadata' => $response->getMetadata(),
            'items' => $this->websiteHydrator->hydrateObjectArray($response->getPayload())
        ];
    }

    public function delete(): Customer
    {
        $response = $this->httpClient->delete('/v2/3as/customers/' . $this->intpCustomerId);

        return $this->customerHydrator->hydrateObject($response->getPayload());
    }

    /**
     * @throws \Exception
     */
    public function generateIFrameDashboardUrl(string $intpcWebsiteId): string
    {
        return $this->iframe->generateDashboardUrl($this->intpCustomerId, $intpcWebsiteId);
    }
}
