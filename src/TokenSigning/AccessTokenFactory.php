<?php

declare(strict_types=1);

namespace Visa\TokenSigning;

use Carbon\Carbon;
use Visa\Company;

class AccessTokenFactory
{
    /**
     * @throws \Exception
     */
    public static function getAccessToken(string $alg, array $company, string $sdkVersion): AccessToken
    {
        if ($alg !== 'RS256') {
            throw new \Exception('Unsupported Algorithm. Supported RS256.');
        }

        $now = Carbon::now();

        return new AccessToken([
            'kid' => $company['id'],
        ], [
            'sub' => $company['domain'],
            'roles' => ['sdk'],
            'exp' => $now->addMinutes(10)->unix(),
            'iat' => $now->unix(),
            'ver' => $sdkVersion
        ], new RS256Signer($company['privateKey']));
    }
}
