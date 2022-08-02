<?php

declare(strict_types=1);

namespace Visa\Customers;

use Laminas\Hydrator\ClassMethodsHydrator;
use Visa\HydratorInterface;

class CustomerHydrator implements HydratorInterface
{
    private ClassMethodsHydrator $hydrator;

    public function __construct()
    {
        $this->hydrator = new ClassMethodsHydrator();
    }

    public function hydrateObject(array $data): Customer
    {
        return $this->hydrator->hydrate($data, new Customer());
    }

    public function hydrateObjectArray(array $dataArray): array
    {
        return array_map(function (array $data) {
            return $this->hydrator->hydrate($data, new Customer());
        }, $dataArray);
    }
}
