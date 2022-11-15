<?php

namespace Visa\Notifications\Subscriptions;

use Laminas\Hydrator\ClassMethodsHydrator;
use Visa\HydratorInterface;

class SubscriptionHydrator implements HydratorInterface
{
    private ClassMethodsHydrator $hydrator;

    public function __construct()
    {
        $this->hydrator = new ClassMethodsHydrator();
    }

    public function hydrateObject(array $data): Subscription
    {
        $this->hydrator->hydrate($data, new Subscription());
    }

    public function hydrateObjectArray(array $arrayData): array
    {
        return array_map(function (array $data) {
            return $this->hydrator->hydrate($data, new Subscription());
        }, $arrayData);
    }
}