<?php

declare(strict_types=1);

namespace Visa\Websites;

class Website
{
    private string $id;
    private string $intpWebsiteId;
    private string $domain;
    private string $partnerId;
    private string $customerId;
    private string $visaTrackingCode;
    private string $packageId;
    private string $packageName;
    private string $createdAt;
    private bool   $inTrial;
    private bool   $hadTrial;
    private Consumption $consumption;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
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

    /**
     * @return string
     */
    public function getVisaTrackingCode(): string
    {
        return $this->visaTrackingCode;
    }

    /**
     * @param string $visaTrackingCode
     */
    public function setVisaTrackingCode(string $visaTrackingCode): void
    {
        $this->visaTrackingCode = $visaTrackingCode;
    }

    /**
     * @return string
     */
    public function getDomain(): string
    {
        return $this->domain;
    }

    /**
     * @param string $domain
     */
    public function setDomain(string $domain): void
    {
        $this->domain = $domain;
    }

    /**
     * @return string
     */
    public function getPartnerId(): string
    {
        return $this->partnerId;
    }

    /**
     * @param string $partnerId
     */
    public function setPartnerId(string $partnerId): void
    {
        $this->partnerId = $partnerId;
    }

    /**
     * @return string
     */
    public function getCustomerId(): string
    {
        return $this->customerId;
    }

    /**
     * @param string $customerId
     */
    public function setCustomerId(string $customerId): void
    {
        $this->customerId = $customerId;
    }

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
    public function getPackageName(): string
    {
        return $this->packageName;
    }

    /**
     * @param string $packageName
     */
    public function setPackageName(string $packageName): void
    {
        $this->packageName = $packageName;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @param string $createdAt
     */
    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return bool
     */
    public function isInTrial(): bool
    {
        return $this->inTrial;
    }

    /**
     * @return bool
     */
    public function getInTrial(): bool
    {
        return $this->inTrial;
    }

    /**
     * @param bool $inTrial
     */
    public function setInTrial(bool $inTrial): void
    {
        $this->inTrial = $inTrial;
    }

    /**
     * @return bool
     */
    public function hasHadTrial(): bool
    {
        return $this->hadTrial;
    }

    /**
     * @return bool
     */
    public function getHadTrial(): bool
    {
        return $this->hadTrial;
    }

    /**
     * @param bool $hadTrial
     */
    public function setHadTrial(bool $hadTrial): void
    {
        $this->hadTrial = $hadTrial;
    }

    /**
     * Get the value of consumption
     */ 
    public function getConsumption(): Consumption
    {
        return $this->consumption;
    }

    /**
     * Set the value of consumption
     *
     * @return  self
     */ 
    public function setConsumption($consumption)
    {
        $this->consumption = $consumption;

        return $this;
    }
}
