<?php

declare(strict_types=1);

namespace Visa\Utils;

class IFrameUtils
{
    public const DEV_DASHBOARD_BASE_URI = 'https://dev-dashboard.va-endpoint.com';
    public const STAGE_DASHBOARD_BASE_URI = 'https://stage-api-gateway.va-endpoint.com';

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
    public function generateDashboardUrl(string $intpcId, string $intpcWebsiteId): string
    {
        $dashboardUri = $this->env === 'dev' ? self::DEV_DASHBOARD_BASE_URI : self::STAGE_DASHBOARD_BASE_URI;

        return $dashboardUri . '?intpc_token=' . $this->auth->generateINTPcAccessToken($intpcId) . '&externalWebsiteId=' . $intpcWebsiteId;
    }
}
