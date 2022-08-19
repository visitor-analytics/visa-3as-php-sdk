<?php

declare(strict_types=1);

namespace Visa\Packages;

use GuzzleHttp\Exception\GuzzleException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator;
use Visa\VisaHttpClient;

class PackagesApi
{
    private VisaHttpClient $httpClient;
    private PackageHydrator $hydrator;

    public function __construct(VisaHttpClient $visaHttpClient)
    {
        $this->httpClient = $visaHttpClient;
        $this->hydrator = new PackageHydrator();
    }

    /**
     * @param array $package
     * @return Package
     * @throws GuzzleException
     * @throws \Exception
     */
    public function create(array $package): Package
    {
        try {
            $newPackageValidationSchema = Validator::arrayType()
                ->key('name', Validator::stringType())
                ->key('price', Validator::floatType())
                ->key('currency', Validator::currencyCode())
                ->key('touchpoints', Validator::number());

            $newPackageValidationSchema->assert($package);

            $response = $this->httpClient->post('/v2/3as/packages', $package);

            return $this->hydrator->hydrateObject($response->getPayload());
        } catch (NestedValidationException $exception) {
            throw new \Exception(json_encode($exception->getMessages()));
        }
    }

    /**
     * @param string $id
     * @return Package
     * @throws GuzzleException
     */
    public function getById(string $id): Package
    {
        $response = $this->httpClient->get('/v2/3as/packages/' . $id);

        return $this->hydrator->hydrateObject($response->getPayload());
    }

    /**
     * @return Package[]
     * @throws GuzzleException
     */
    public function list(): array
    {
        $response = $this->httpClient->get('/v2/3as/packages');

        return $this->hydrator->hydrateObjectArray($response->getPayload());
    }
}
