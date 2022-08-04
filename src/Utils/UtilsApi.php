<?php

declare(strict_types=1);

namespace Visa\Utils;

use Visa\TokenSigning\AccessToken;
use Visa\TokenSigning\AccessTokenFactory;

class UtilsApi
{
    public AuthUtils $auth;
    public IFrameUtils $iframe;

    /**
     * @throws \Exception
     */
    public function __construct(array $intp, string $env)
    {
        $this->auth = new AuthUtils($intp, $env);
        $this->iframe = new IFrameUtils($this->auth->generateINTPcAccessToken(), $env);
    }
}

class IFrameUtils
{
    public const DEV_DASHBOARD_BASE_URI = '';
    public const PROD_DASHBOARD_BASE_URI = '';

    private string $env;
    private string $accessToken;

    public function __construct(string $accessToken, string $env)
    {
        $this->env = $env;
        $this->accessToken = $accessToken;
    }

    public function generateDashboardUri(): string
    {
        $dashboardUri = $this->env === 'dev' ? self::DEV_DASHBOARD_BASE_URI : self::PROD_DASHBOARD_BASE_URI;

        return $dashboardUri . '?intpc_token=' . $this->accessToken;
    }
}

class AuthUtils
{
    private array $intp;
    private string $env;

    public function __construct(array $intp, string $env)
    {
        $this->intp = $intp;
        $this->env = $env;
    }

    /**
     * @throws \Exception
     */
    public function generateINTPAccessToken(): string
    {
        return $this->generateAccessToken(AccessTokenFactory::ROLE_INTP)->getValue();
    }

    /**
     * @throws \Exception
     */
    public function generateINTPcAccessToken(): string
    {
        return $this->generateAccessToken(AccessTokenFactory::ROLE_INTPC)->getValue();
    }

    /**
     * @throws \Exception
     */
    private function generateAccessToken(string $role): AccessToken
    {
        return AccessTokenFactory::getAccessToken(
            [
                'alg' => 'RS256',
                'kid' => $this->intp['id'],
                'jwtClaims' => [
                    'sub' => $this->intp['domain'],
                    'role' => $role,
                ],
                'env' => $this->env,
                'privateKey' => $this->intp['privateKey']
            ]
        );
    }
}
