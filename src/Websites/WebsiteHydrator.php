<?php

declare(strict_types=1);

namespace Visa\Websites;

use Visa\HydratorInterface;
use Visa\Websites\ConsumptionHydrator;

class WebsiteHydrator implements HydratorInterface
{
    private ConsumptionHydrator $consumptionHydrator;

    public function __construct() {
        $this->consumptionHydrator = new ConsumptionHydrator();
    }

    public function hydrateObject(array $data): Website
    {
        $website = new Website();
        
        $website->setId($data['id']);
        $website->setStatus($data["status"]);
        $website->setIntpId($data["intpId"]);
        $website->setIntpWebsiteId($data["intpWebsiteId"]);
        $website->setIntpCustomerId($data["intpCustomerId"]);
        $website->setVisaTrackingCode($data['visaTrackingCode'] ?? null);
        $website->setVisaMaxPrivacyTrackingCode($data['visaMaxPrivacyModeTrackingCode'] ?? null);

        $website->setDomain($data['domain']);
        $website->setPackageId($data['packageId']);
        $website->setPackageName($data['packageName']);
        $website->setBillingInterval($data['billingInterval']);
        $website->setLastPackageChangeAt($data['lastPackageChangeAt'] ?? null);
        $website->setPlannedDowngradePackageId($data['plannedDowngradePackageId'] ?? null);
        $website->setPlannedDowngradePackageName($data['plannedDowngradePackageName'] ?? null);
        $website->setPlannedDowngradePackageInterval($data['plannedDowngradePackageInterval'] ?? null);

        $website->setInTrial($data['inTrial'] ?? false);
        $website->setHadTrial($data['hadTrial'] ?? false);

        $website->setCreatedAt($data['createdAt']);
        $website->setExpiresAt($data['expiresAt']);
        $website->setStpResetAt($data['stpResetAt']);

        if (!isset($data['consumption'])) {
            $website->setConsumption(null);
            return $website;
        }

        $website->setConsumption($this->consumptionHydrator->hydrateObject($data['consumption']));

        return $website;
    }

    public function hydrateObjectArray(array $arrayData): array
    {
        return array_map(function (array $data) {
            return $this->hydrateObject($data);
        }, $arrayData);
    }
}
