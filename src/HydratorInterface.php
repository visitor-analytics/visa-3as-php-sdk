<?php

declare(strict_types=1);

namespace Visa;

interface HydratorInterface
{
    public function hydrateObject(array $data): object;
    public function hydrateObjectArray(array $arrayData): array;
}
