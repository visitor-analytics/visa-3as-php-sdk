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
        
        $website->setId($data['id'] ?? null);
        $website->setStatus($data["status"] ?? null);
        $website->setIntpId($data["intpId"] ?? null);
        $website->setIntpWebsiteId($data["intpWebsiteId"] ?? null);
        $website->setIntpCustomerId($data["intpCustomerId"] ?? null);
        $website->setVisaTrackingCode($data['visaTrackingCode'] ?? null);

        $website->setDomain($data['domain'] ?? null);
        $website->setPackageId($data['packageId'] ?? null);
        $website->setPackageName($data['packageName'] ?? null);
        $website->setBillingInterval($data['billingInterval'] ?? null);
        $website->setLastPackageChangeAt($data['lastPackageChangeAt'] ?? null);
        $website->setPlannedDowngradePackageId($data['plannedDowngradePackageId'] ?? null);
        $website->setPlannedDowngradePackageName($data['plannedDowngradePackageName'] ?? null);
        $website->setPlannedDowngradePackageInterval($data['plannedDowngradePackageInterval'] ?? null);

        $website->setInTrial($data['inTrial'] ?? false);
        $website->setHadTrial($data['hadTrial'] ?? false);

        $website->setCreatedAt($data['createdAt'] ?? null);
        $website->setExpiresAt($data['expiresAt'] ?? null);
        $website->setStpResetAt($data['stpResetAt'] ?? null);

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
