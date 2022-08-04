<?php

namespace Visa\Packages;

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator;
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
        try {
            $updatePackageValidationSchema = Validator::arrayType()
                ->key('name', Validator::stringType());

            $updatePackageValidationSchema->assert($package);

            $response = $this->httpClient->patch('/v2/3as/packages/' . $this->packageId, $package);

            return $this->hydrator->hydrateObject($response->getPayload());
        } catch (NestedValidationException $exception) {
            throw new \Exception(json_encode($exception->getMessages()));
        }
    }
}
