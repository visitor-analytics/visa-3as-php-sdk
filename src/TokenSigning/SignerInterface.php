<?php

declare(strict_types=1);

namespace Visa\TokenSigning;

interface SignerInterface
{
    public function sign(array $payload, array $options): string;
}
