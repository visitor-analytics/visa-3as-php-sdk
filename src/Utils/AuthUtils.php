<?php

namespace Visa\Utils;

use Visa\TokenSigning\AccessTokenFactory;

class AuthUtils
{
    private array $intp;

    public function __construct(array $intp)
    {
        $this->intp = $intp;
    }

    /**
     * @throws \Exception
     */
    public function generateINTPAccessToken(): string
    {
        return AccessTokenFactory::getAccessToken(
            [
                'alg' => 'RS256',
                'kid' => $this->intp['id'],
                'jwtClaims' => [
                    'intp' => $this->intp['id'],
                    'role' => AccessTokenFactory::ROLE_INTP,
                ],
                'privateKey' => $this->intp['privateKey']
            ]
        )->getValue();
    }

    /**
     * @throws \Exception
     */
    public function generateINTPcAccessToken(string $intpcId): string
    {
        return AccessTokenFactory::getAccessToken(
            [
                'alg' => 'RS256',
                'kid' => $this->intp['id'],
                'jwtClaims' => [
                    'intp' => $this->intp['id'],
                    'intpc' => $intpcId,
                    'role' => AccessTokenFactory::ROLE_INTPC,
                ],
                'privateKey' => $this->intp['privateKey']
            ]
        )->getValue();
    }
}
