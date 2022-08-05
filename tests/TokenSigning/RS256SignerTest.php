<?php

declare(strict_types=1);

namespace TokenSigning;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use Visa\TokenSigning\RS256Signer;
use Visa\TokenSigning\SignerInterface;

final class RS256SignerTest extends TestCase
{
    private SignerInterface $signer;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        // Create the private and public key
        $res = openssl_pkey_new(["digest_alg" => "sha256",
            "private_key_bits" => 4096,
            "private_key_type" => OPENSSL_KEYTYPE_RSA,]);

        // Extract the private key from $res to $privKey
        openssl_pkey_export($res, $privKey);

        $this->signer = new RS256Signer($privKey);
    }

    public function testAccessTokenHasJwtFormat(): void
    {
        $now = new DateTimeImmutable();

        $accessToken = $this->signer->sign([
            'iat' => $now,
            'exp' => $now->modify('+10 minutes'),
            'roles' => ['intp'],
            'intp' => 'be784859-d477-404c-8021-c5558498a1fa',
            'intpc' => null
        ], ['kid' => 'be784859-d477-404c-8021-c5558498a1fa']);

        $this->assertMatchesRegularExpression("/^([a-zA-Z\d_=]+)\.([a-zA-Z\d_=]+)\.([a-zA-Z\d_\-\/=]*)$/", $accessToken);
    }

    public function testSubsequentAccessTokensHaveDifferentSignatures(): void
    {
        $now = new DateTimeImmutable();

        $firstAccessToken = $this->signer->sign([
            'iat' => $now,
            'exp' => $now->modify('+10 minutes'),
            'roles' => ['intp'],
            'intp' => 'be784859-d477-404c-8021-c5558498a1fa',
            'intpc' => null,
        ], ['kid' => 'be784859-d477-404c-8021-c5558498a1fa']);

        $secondAccessToken = $this->signer->sign([
            'iat' => $now,
            'exp' => $now->modify('+10 minutes'),
            'roles' => ['intp'],
            'intp' => 'be784859-d477-404c-8021-c5558498a1fa',
            'intpc' => null,
        ], ['kid' => 'be784859-d477-404c-8021-c5558498a1fa']);

        $this->assertNotEquals($firstAccessToken, $secondAccessToken);
    }
}
