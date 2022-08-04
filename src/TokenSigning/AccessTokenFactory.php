<?php

declare(strict_types=1);

namespace Visa\TokenSigning;

use Carbon\Carbon;

class AccessTokenFactory
{
    const ROLE_INTP = 'intp';
    const ROLE_INTPC = 'intpc';
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
            'sub' => $config['jwtClaims']['sub'],
            'roles' => [$config['jwtClaims']['role']],
            'exp' => $now->addMinutes(10)->unix(),
            'iat' => $now->unix(),
            'ver' => $config['env']
        ], new RS256Signer($config['privateKey']));
    }
}
