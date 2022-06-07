<?php

declare(strict_types=1);

namespace Visa\TokenSigning;

class AccessToken
{
    private array $header;
    private array $payload;

    private SignerInterface $signer;

    private string $value;

    public function __construct(
        array $header,
        array $payload,
        SignerInterface $signer
    ) {
        $this->header = $header;
        $this->payload = $payload;
        $this->signer = $signer;

        $this->value = $this->sign();
    }

    private function sign(): string
    {
        return $this->signer->sign($this->payload, $this->header);
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
