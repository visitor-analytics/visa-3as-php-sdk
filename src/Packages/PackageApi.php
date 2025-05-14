<?php

namespace Visa\Packages;

use Visa\VisaHttpClient;

class PackageApi
{
    private string $packageId;

    private VisaHttpClient $httpClient;
    private PackageHydrator $hydrator;

    public function __construct(VisaHttpClient $visaHttpClient)
    {
        $this->httpClient = $visaHttpClient;
        $this->hydrator = new PackageHydrator();
    }

    public function setPackageId(string $packageId): PackageApi
    {
        $this->packageId = $packageId;

        return $this;
    }

    public function update(array $package): Package
    {
        $response = $this->httpClient->patch('/v2/3as/packages/' . $this->packageId, $package);

        return $this->hydrator->hydrateObject($response->getPayload());
    }
}
