<?php

declare(strict_types=1);

namespace Visa\Websites;

use Laminas\Hydrator\ClassMethodsHydrator;
use Visa\HydratorInterface;

class WebsiteHydrator implements HydratorInterface
{
    private ClassMethodsHydrator $hydrator;

    public function __construct()
    {
        $this->hydrator = new ClassMethodsHydrator();
    }

    public function hydrateObject(array $data): Website
    {
        return $this->hydrator->hydrate($data, new Website());
    }

    public function hydrateObjectArray(array $arrayData): array
    {
        return array_map(function (array $data) {
            return $this->hydrator->hydrate($data, new Website());
        }, $arrayData);
    }
}
