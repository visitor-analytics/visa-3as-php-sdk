<?php

declare(strict_types=1);

namespace Visa\Customers;

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator;
use Visa\VisaHttpClient;

class CustomersApi
{
    private VisaHttpClient $httpClient;
    private CustomerHydrator $hydrator;

    public function __construct(VisaHttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
        $this->hydrator = new CustomerHydrator();
    }

    public function create(array $customer): Customer
    {
        $newClientValidationSchema = Validator::arrayType()
            ->key('intpCustomerId', Validator::stringType())
            ->key('email', Validator::email());

        try {
            $newClientValidationSchema->assert($customer);

            $response = $this->httpClient->post('/v2/3as/customers', $customer);

            return $this->hydrator->hydrateObject($response->getPayload());
        } catch (NestedValidationException $exception) {
            throw new \Exception(json_encode($exception->getMessages()));
        }
    }

    public function list($pagination = ['page' => 0, 'pageSize' => 10]): array
    {
        $response = $this->httpClient->get("/v2/3as/customers?page=" . $pagination['page'] . '&pageSize=' . $pagination['pageSize']);

        return  [
            'metadata' => $response->getMetadata(),
            'items' => $this->hydrator->hydrateObjectArray($response->getPayload())
        ];
    }

    public function getByIntpCustomerId($intpCustomerId): Customer
    {
        $response = $this->httpClient->get('/v2/3as/customers/' . $intpCustomerId);

        return $this->hydrator->hydrateObject($response->getPayload());
    }
}
