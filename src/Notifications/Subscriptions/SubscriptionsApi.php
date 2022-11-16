<?php

namespace Visa\Notifications\Subscriptions;

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator;
use Visa\VisaHttpClient;

class SubscriptionsApi
{
    const PATH = "/v2/3as/notifications/subscriptions";

    private VisaHttpClient $httpClient;
    private SubscriptionHydrator $hydrator;

    public function __construct(VisaHttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
        $this->hydrator = new SubscriptionHydrator();
    }

    public  function upgrade(array $message): Subscription
    {
        $this->validatePackageChange($message);

        $response = $this->httpClient->post(self::PATH . '/upgrade', $message);

        return $this->hydrator->hydrateObject($response->getPayload());
    }

    public  function downgrade(array $message): Subscription
    {
        $this->validatePackageChange($message);

        $response = $this->httpClient->post(self::PATH . '/downgrade', $message);

        return $this->hydrator->hydrateObject($response->getPayload());
    }

    public  function cancel(array $message): Subscription {
        $this->validateStatusChange($message);

        $response = $this->httpClient->post(self::PATH . '/cancel', $message);

        return $this->hydrator->hydrateObject($response->getPayload());
    }

    public  function resume(array $message): Subscription {
        $this->validateStatusChange($message);

        $response = $this->httpClient->post(self::PATH . '/resume', $message);

        return $this->hydrator->hydrateObject($response->getPayload());
    }

    public  function deactivate(array $message): Subscription {
        $this->validateStatusChange($message);

        $response = $this->httpClient->post(self::PATH . '/deactivate', $message);

        return $this->hydrator->hydrateObject($response->getPayload());
    }

    private function validatePackageChange(array $message): void
    {
        $validationSchema = Validator::arrayType()
            ->key(
                'intpWebsiteId',
                Validator::stringType()->notOptional()
            )
            ->key(
                'packageId',
                Validator::stringType()->uuid()->notOptional()
            );

        try {
            $validationSchema->assert($message);
        } catch (NestedValidationException $exception) {
            throw new \Exception(json_encode($exception->getMessages()));
        }
    }


    private function validateStatusChange(array $message): void
    {
        $validationSchema = Validator::arrayType()
            ->key(
                'intpWebsiteId',
                Validator::stringType()->notOptional()
            );

        try {
            $validationSchema->assert($message);
        } catch (NestedValidationException $exception) {
            throw new \Exception(json_encode($exception->getMessages()));
        }
    }
}