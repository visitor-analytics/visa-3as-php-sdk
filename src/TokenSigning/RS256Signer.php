<?php

declare(strict_types=1);

namespace Visa\TokenSigning;

use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Signer\Rsa\Sha256;

class RS256Signer implements SignerInterface
{
    private Configuration $config;

    public function __construct(string $privateKey)
    {
        $this->config = Configuration::forAsymmetricSigner(
            new Sha256(),
            InMemory::plainText($privateKey),
            InMemory::plainText("-")
        );
    }

    public function sign(array $payload, array $options): string
    {
        return $this->config->builder()
            ->issuedAt(new \DateTimeImmutable())
            ->expiresAt((new \DateTimeImmutable())->modify('+10 minutes'))
            ->withClaim('roles', $payload['roles'])
            ->withClaim('intp_id', $payload['intp_id'])
            ->withClaim('intpc_id', $payload['intpc_id'])
            ->withHeader('kid', $options['kid'])
            ->withHeader('typ', 'JWT')
            ->getToken(
                $this->config->signer(),
                $this->config->signingKey()
            )
            ->toString();
    }
}
