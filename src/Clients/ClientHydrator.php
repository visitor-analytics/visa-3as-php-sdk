<?php

declare(strict_types=1);

namespace Visa\Clients;

use Laminas\Hydrator\ClassMethodsHydrator;
use Visa\HydratorInterface;

class ClientHydrator implements HydratorInterface
{
    private ClassMethodsHydrator $hydrator;

    public function __construct()
    {
        $this->hydrator = new ClassMethodsHydrator();
    }

    public function hydrateObject(array $data): Client
    {
        return $this->hydrator->hydrate($data, new Client());
    }

    public function hydrateObjectArray(array $dataArray): array
    {
        return array_map(function (array $data) {
            return $this->hydrator->hydrate($data, new Client());
        }, $dataArray);
    }
}
