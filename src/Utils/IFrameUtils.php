<?php

declare(strict_types=1);

namespace Visa\Utils;

use Exception;

class IFrameUtils
{
    public const DEV_DASHBOARD_BASE_URI = 'https://dev-dashboard.va-endpoint.com';
    public const STAGE_DASHBOARD_BASE_URI = 'https://stage-dashboard-3as.va-endpoint.com';
    public const PRODUCTION_DASHBOARD_BASE_URI = 'https://app-3as.visitor-analytics.io';

    private AuthUtils $auth;

    private string $env;

    // visa dashboard
    private string $dashboardUri;

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
        switch ($this->env) {
            case 'dev':
                $this->dashboardUri = self::DEV_DASHBOARD_BASE_URI;
                break;
            case 'stage':
                $this->dashboardUri = self::STAGE_DASHBOARD_BASE_URI;
                break;
            case 'production':
                $this->dashboardUri = self::PRODUCTION_DASHBOARD_BASE_URI;
                break;
            default:
                throw new Exception("unsupported sdk env");
                break;
        }

        return $this->dashboardUri . '?intpc_token=' . $this->auth->generateINTPcAccessToken($intpcId) . '&externalWebsiteId=' . $intpcWebsiteId;
    }
}
