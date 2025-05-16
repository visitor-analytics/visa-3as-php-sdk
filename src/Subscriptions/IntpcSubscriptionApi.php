<?php

namespace Visa\Subscriptions;

use Visa\VisaHttpClient;

class IntpcSubscriptionApi implements SubscriptionManagement
{
    const PATH = "/v3/3as/intpc-subscriptions";

    private VisaHttpClient $httpClient;

    public function __construct(VisaHttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public  function upgrade(array $message): void
    {
        $this->httpClient->post(self::PATH . '/upgrade', $message);
    }

    public  function downgrade(array $message): void
    {
        $this->httpClient->post(self::PATH . '/downgrade', $message);
    }

    public  function cancel(array $message): void
    {
        $this->httpClient->post(self::PATH . '/cancel', $message);
    }

    public  function resume(array $message): void
    {
        $this->httpClient->post(self::PATH . '/resume', $message);
    }

    public  function deactivate(array $message): void
    {
        $this->httpClient->post(self::PATH . '/deactivate', $message);
    }
}
