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

        return new AccessToken([
            'kid' => $config['kid'],
        ], [
            'roles' => [$config['claims']['role']],
            'intp_id' => $config['claims']['intp_id'],
            'intpc_id' => $config['claims']['intpc_id'] ?? null,
        ], new RS256Signer($config['privateKey']));
    }
}
