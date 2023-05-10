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
                ->key('touchpoints', Validator::intVal()->min(1))
                ->key('price', Validator::floatVal()->min(0))
                ->key('currency', Validator::oneOf(
                    Validator::equals('EUR'),
                    Validator::equals('USD'),
                    Validator::equals('RON')
                ))
                ->key('period', Validator::oneOf(
                    Validator::equals('monthly'),
                    Validator::equals('yearly')
                )
                );

            $newPackageValidationSchema->assert($package);

            $response = $this->httpClient->post('/v2/3as/packages', $package);

            return $this->hydrator->hydrateObject($response->getPayload());
        } catch (NestedValidationException $exception) {
            throw new \Exception(
                json_encode(
                    $exception->getMessages([
                        'period' => 'period must be one of "yearly" or "monthly"',
                        'currency' => 'currency must be one of "EUR", "USD" or "RON"'
                    ])
                )
            );
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
