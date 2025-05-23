<?php

declare(strict_types=1);

namespace Visa\Intpcs;

use GuzzleHttp\Exception\GuzzleException;
use Visa\HydratorInterface;
use Visa\Utils\IFrameUtils;
use Visa\VisaHttpClient;
use Visa\Websites\WebsiteHydrator;

class IntpcApi
{
    private string $intpCustomerId;

    private IFrameUtils $iframe;
    private VisaHttpClient $httpClient;
    private HydratorInterface $websiteHydrator;
    private HydratorInterface $intpcHydrator;

    public function __construct(VisaHttpClient $httpClient, IFrameUtils $iframe)
    {
        $this->iframe = $iframe;
        $this->httpClient = $httpClient;

        $this->websiteHydrator = new WebsiteHydrator();
        $this->intpcHydrator = new IntpcHydrator();
    }

    public function setIntpcId(string $intpCustomerId): IntpcApi
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

    public function delete(): Intpc
    {
        $response = $this->httpClient->delete('/v2/3as/customers/' . $this->intpCustomerId);

        return $this->intpcHydrator->hydrateObject($response->getPayload());
    }

    /**
     * @throws \Exception
     */
    public function generateIFrameDashboardUrl(string $intpcWebsiteId): string
    {
        return $this->iframe->generateDashboardUrl($this->intpCustomerId, $intpcWebsiteId);
    }
}
