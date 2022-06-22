<?php

declare(strict_types=1);

namespace Visa\Packages;

use GuzzleHttp\Exception\GuzzleException;
use Visa\VisaHttpClient;

class PackagesApi
{
    private VisaHttpClient $client;
    private PackageHydrator $hydrator;

    public function __construct(VisaHttpClient $client)
    {
        $this->client = $client;
        $this->hydrator = new PackageHydrator();
    }

    /**
     * @param string $id
     * @return Package
     * @throws GuzzleException
     */
    public function getById(string $id): Package
    {
        $response = $this->client->get('/v2/3as/packages/' . $id);

        return $this->hydrator->hydrateObject($response->getPayload());
    }

    /**
     * @return Package[]
     * @throws GuzzleException
     */
    public function list(): array
    {
        $response = $this->client->get('/v2/3as/packages');

        return $this->hydrator->hydrateObjectArray($response->getPayload());
    }
}
