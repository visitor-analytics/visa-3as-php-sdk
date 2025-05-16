<?php

declare(strict_types=1);

namespace Visa\Intpcs;

use Laminas\Hydrator\ClassMethodsHydrator;
use Visa\HydratorInterface;

class IntpcHydrator implements HydratorInterface
{
    private ClassMethodsHydrator $hydrator;

    public function __construct()
    {
        $this->hydrator = new ClassMethodsHydrator();
    }

    public function hydrateObject(array $data): Intpc
    {
        return $this->hydrator->hydrate($data, new Intpc());
    }

    public function hydrateObjectArray(array $dataArray): array
    {
        return array_map(function (array $data) {
            return $this->hydrator->hydrate($data, new Intpc());
        }, $dataArray);
    }
}
