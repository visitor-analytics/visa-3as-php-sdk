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
                'claims' => [
                    'role' => AccessTokenFactory::ROLE_INTP,
                    'intp_id' => $this->intp['id'],
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
                'claims' => [
                    'role' => AccessTokenFactory::ROLE_INTPC,
                    'intp_id' => $this->intp['id'],
                    'intpc_id' => $intpcId,
                ],
                'privateKey' => $this->intp['privateKey']
            ]
        )->getValue();
    }
}
