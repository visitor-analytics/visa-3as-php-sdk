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
        switch ($config['alg']) {
            case 'RS256': {
                $signer = new RS256Signer($config['privateKey']);
                break;
            }
            case 'RS512': {
                $signer = new RS512Signer($config['privateKey']);
                break;
            }
            default: {
                throw new \Exception('Unsupported Algorithm. Supported RS256, RS512.');
            }
        }

        return new AccessToken([
            'kid' => $config['kid'],
        ], [
            'roles' => [$config['claims']['role']],
            'intp_id' => $config['claims']['intp_id'],
            'intpc_id' => $config['claims']['intpc_id'] ?? null,
        ], $signer);
    }
}
