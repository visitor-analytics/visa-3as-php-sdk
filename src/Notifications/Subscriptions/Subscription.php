<?php

namespace Visa\Notifications\Subscriptions;

class Subscription
{
    private string $intpWebsiteId;
    private string $packageId;

    /**
     * @return string
     */
    public function getPackageId(): string
    {
        return $this->packageId;
    }

    /**
     * @param string $packageId
     */
    public function setPackageId(string $packageId): void
    {
        $this->packageId = $packageId;
    }

    /**
     * @return string
     */
    public function getIntpWebsiteId(): string
    {
        return $this->intpWebsiteId;
    }

    /**
     * @param string $intpWebsiteId
     */
    public function setIntpWebsiteId(string $intpWebsiteId): void
    {
        $this->intpWebsiteId = $intpWebsiteId;
    }
}