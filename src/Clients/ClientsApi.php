<?php

declare(strict_types=1);

namespace Visa\Clients;

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator;
use Visa\VisaHttpClient;

class ClientsApi
{
    private VisaHttpClient $httpClient;
    private ClientHydrator $hydrator;

    public function __construct(VisaHttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
        $this->hydrator = new ClientHydrator();
    }

    public function create(array $client): Client
    {
        $newClientValidationSchema = Validator::arrayType()
            ->key('externalId', Validator::stringType())
            ->key('email', Validator::email());

        try {
            $newClientValidationSchema->assert($client);

            $response = $this->httpClient->post('/v2/3as/clients', $client);

            return $this->hydrator->hydrateObject($response->getPayload());
        } catch (NestedValidationException $exception) {
            throw new \Exception(json_encode($exception->getMessages()));
        }
    }

    public function list($pagination = ['page' => 0, 'pageSize' => 10]): array
    {
        $response = $this->httpClient->get("/v2/3as/clients?page=" . $pagination['page'] . '&pageSize=' . $pagination['pageSize']);

        return  [
            'metadata' => $response->getMetadata(),
            'items' => $this->hydrator->hydrateObjectArray($response->getPayload())
        ];
    }

    public function getByExternalId($externalId): Client
    {
        $response = $this->httpClient->get('/v2/3as/clients/' . $externalId);

        return $this->hydrator->hydrateObject($response->getPayload());
    }
}
