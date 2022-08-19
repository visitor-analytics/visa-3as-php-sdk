<?php

declare(strict_types=1);

namespace Visa\TokenSigning;

use Carbon\Carbon;

class AccessTokenFactory
{
    public const ROLE_INTP = 'intp';
    public const ROLE_INTPC = 'intpc';
    /**
     * @throws \Exception
     */
    public static function getAccessToken(array $config): AccessToken
    {
        if (!array_key_exists('alg', $config) || $config['alg'] !== 'RS256') {
            throw new \Exception('Unsupported Algorithm. Supported RS256.');
        }

        $now = Carbon::now();

        return new AccessToken([
            'kid' => $config['kid'],
        ], [
            'roles' => [$config['jwtClaims']['role']],
            'intp' => $config['jwtClaims']['intp'],
            'intpc' => $config['jwtClaims']['intpc'] ?? null,
            'exp' => $now->addMinutes(10)->unix(),
            'iat' => $now->unix(),
        ], new RS256Signer($config['privateKey']));
    }
}
