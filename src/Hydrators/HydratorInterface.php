<?php

declare(strict_types=1);

namespace Visa\Hydrators;

interface HydratorInterface
{
    public function hydrateObject(array $data): object;
    public function hydrateObjectArray(array $data): array;
}
