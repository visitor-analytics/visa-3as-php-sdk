<?php

declare(strict_types=1);

namespace Visa\Websites;

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator;
use Visa\HydratorInterface;
use Visa\VisaHttpClient;

class WebsitesApi
{
    private VisaHttpClient $httpClient;
    private HydratorInterface $websiteHydrator;

    public function __construct(VisaHttpClient $httpClient)
    {
        $this->httpClient = $httpClient;

        $this->websiteHydrator = new WebsiteHydrator();
    }

    public function list(array $pagination = ['page' => 0, 'pageSize' => 10]): array
    {
        $response = $this->httpClient->get('/v2/3as/websites?page=' . $pagination['page'] . '&pageSize=' . $pagination['pageSize']);

        return [
            'metadata' => $response->getMetadata(),
            'items' => $this->websiteHydrator->hydrateObjectArray($response->getPayload())
        ];
    }

    public function getByIntpWebsiteId($intpWebsiteId): Website
    {
        $response = $this->httpClient->get('/v2/3as/websites/' . $intpWebsiteId);

        return $this->websiteHydrator->hydrateObject($response->getPayload());
    }

    public function create(array $website): Website
    {
        $newWebsiteValidationSchema = Validator::arrayType()
            ->key('intpWebsiteId', Validator::stringType())
            ->key('intpCustomerId', Validator::stringType())
            ->key('domain', Validator::stringType())
            ->key('packageId', Validator::optional(Validator::stringType()->uuid(4)))
            ->key('billingDate', Validator::optional(Validator::stringType()));

        try {
            $newWebsiteValidationSchema->assert($website);

            $response = $this->httpClient->post('/v2/3as/websites', $website);

            return $this->websiteHydrator->hydrateObject($response->getPayload());
        } catch (NestedValidationException $exception) {
            throw new \Exception(json_encode($exception->getMessages()));
        }
    }
}
