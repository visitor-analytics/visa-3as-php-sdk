<?php

namespace Visa;

use GuzzleHttp\Exception\GuzzleException;
use Visa\Hydrators\PackageHydrator;
use Visa\Models\Package;

class Packages
{
    private Client $client;
    private PackageHydrator $hydrator;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->hydrator = new PackageHydrator();
    }

    /**
     * @param string $id
     * @return Package
     * @throws GuzzleException
     */
    public function get(string $id): Package
    {
        $packagePayload = $this->client->get('/v2/3as/packages/' . $id);

        return $this->hydrator->hydrateObject($packagePayload);
    }

    /**
     * @return Package[]
     * @throws GuzzleException
     */
    public function getMany(array $criteria = []): array
    {
        $packagesPayload = $this->client->get('/v2/3as/packages');

        return $this->hydrator->hydrateObjectArray($packagesPayload);
    }
}
