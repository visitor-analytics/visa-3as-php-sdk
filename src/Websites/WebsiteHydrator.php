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
        $website->setIntpWebsiteId($data['intpWebsiteId'] ?? null);
        $website->setDomain($data['domain'] ?? null);
        $website->setPartnerId($data['intpId'] ?? null);
        $website->setCustomerId($data['intpCustomerId'] ?? null);
        $website->setVisaTrackingCode($data['visaTrackingCode'] ?? null);
        $website->setPackageId($data['packageId'] ?? null);
        $website->setPackageName($data['packageName'] ?? null);
        $website->setInTrial($data['inTrial'] ?? false);
        $website->setHadTrial($data['hadTrial'] ?? false);
        $website->setCreatedAt($data['createdAt'] ?? null);

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
