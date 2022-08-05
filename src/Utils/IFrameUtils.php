<?php

declare(strict_types=1);

namespace Visa\Utils;

class IFrameUtils
{
    public const DEV_DASHBOARD_BASE_URI = 'https://dev-dashboard.va-endpoint.com';
    public const PROD_DASHBOARD_BASE_URI = '';

    private AuthUtils $auth;

    private string $env;

    public function __construct(AuthUtils $auth, string $env)
    {
        $this->env = $env;
        $this->auth = $auth;
    }

    /**
     * @throws \Exception
     */
    public function generateDashboardUri(string $customerVisaId): string
    {
        $dashboardUri = $this->env === 'dev' ? self::DEV_DASHBOARD_BASE_URI : self::PROD_DASHBOARD_BASE_URI;

        return $dashboardUri . '?intpc_token=' . $this->auth->generateINTPcAccessToken($customerVisaId);
    }
}


