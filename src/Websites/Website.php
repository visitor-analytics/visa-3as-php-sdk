<?php

declare(strict_types=1);

namespace Visa\Websites;

class Website
{
    private string $id;
    private string $status;
    private string $intpId;
    private string $intpWebsiteId;
    private string $intpCustomerId;
    private ?string $visaTrackingCode;
    private ?string $visaMaxPrivacyModeTrackingCode;

    private string $domain;
    private string $packageId;
    private string $packageName;
    private string $billingInterval;
    private ?string $lastPackageChangeAt;
    private ?string $plannedDowngradePackageId;
    private ?string $plannedDowngradePackageName;
    private ?string $plannedDowngradePackageInterval;

    private bool   $inTrial;
    private bool   $hadTrial;

    private string $createdAt;
    private string $expiresAt;
    private string $stpResetAt;

    private ?Consumption $consumption;

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
    public function getVisaTrackingCode(): ?string
    {
        return $this->visaTrackingCode;
    }

    /**
     * @param string|null $visaTrackingCode
     */
    public function setVisaTrackingCode(?string $visaTrackingCode): void
    {
        $this->visaTrackingCode = $visaTrackingCode;
    }

    /**
     * @return string
     */
    public function getVisaMaxPrivacyTrackingCode(): ?string
    {
        return $this->visaMaxPrivacyModeTrackingCode;
    }

    /**
     * @param string|null $visaTrackingCode
     */
    public function setVisaMaxPrivacyTrackingCode(?string $visaTrackingCode): void
    {
        $this->visaMaxPrivacyModeTrackingCode = $visaTrackingCode;
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

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of intpId
     */ 
    public function getIntpId()
    {
        return $this->intpId;
    }

    /**
     * Set the value of intpId
     *
     * @return  self
     */ 
    public function setIntpId($intpId)
    {
        $this->intpId = $intpId;

        return $this;
    }

    /**
     * Get the value of intpCustomerId
     */ 
    public function getIntpCustomerId()
    {
        return $this->intpCustomerId;
    }

    /**
     * Set the value of intpCustomerId
     *
     * @return  self
     */ 
    public function setIntpCustomerId($intpCustomerId)
    {
        $this->intpCustomerId = $intpCustomerId;

        return $this;
    }

    /**
     * Get the value of billingInterval
     */ 
    public function getBillingInterval()
    {
        return $this->billingInterval;
    }

    /**
     * Set the value of billingInterval
     *
     * @return  self
     */ 
    public function setBillingInterval($billingInterval)
    {
        $this->billingInterval = $billingInterval;

        return $this;
    }

    /**
     * Get the value of lastPackageChangeAt
     */ 
    public function getLastPackageChangeAt()
    {
        return $this->lastPackageChangeAt;
    }

    /**
     * Set the value of lastPackageChangeAt
     *
     * @return  self
     */ 
    public function setLastPackageChangeAt($lastPackageChangeAt)
    {
        $this->lastPackageChangeAt = $lastPackageChangeAt;

        return $this;
    }

    /**
     * Get the value of plannedDowngradePackageId
     */ 
    public function getPlannedDowngradePackageId()
    {
        return $this->plannedDowngradePackageId;
    }

    /**
     * Set the value of plannedDowngradePackageId
     *
     * @return  self
     */ 
    public function setPlannedDowngradePackageId($plannedDowngradePackageId)
    {
        $this->plannedDowngradePackageId = $plannedDowngradePackageId;

        return $this;
    }

    /**
     * Get the value of plannedDowngradePackageName
     */ 
    public function getPlannedDowngradePackageName()
    {
        return $this->plannedDowngradePackageName;
    }

    /**
     * Set the value of plannedDowngradePackageName
     *
     * @return  self
     */ 
    public function setPlannedDowngradePackageName($plannedDowngradePackageName)
    {
        $this->plannedDowngradePackageName = $plannedDowngradePackageName;

        return $this;
    }

    /**
     * Get the value of plannedDowngradePackageInterval
     */ 
    public function getPlannedDowngradePackageInterval()
    {
        return $this->plannedDowngradePackageInterval;
    }

    /**
     * Set the value of plannedDowngradePackageInterval
     *
     * @return  self
     */ 
    public function setPlannedDowngradePackageInterval($plannedDowngradePackageInterval)
    {
        $this->plannedDowngradePackageInterval = $plannedDowngradePackageInterval;

        return $this;
    }

    /**
     * Get the value of expiresAt
     */ 
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * Set the value of expiresAt
     *
     * @return  self
     */ 
    public function setExpiresAt($expiresAt)
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }

    /**
     * Get the value of stpResetAt
     */ 
    public function getStpResetAt()
    {
        return $this->stpResetAt;
    }

    /**
     * Set the value of stpResetAt
     *
     * @return  self
     */ 
    public function setStpResetAt($stpResetAt)
    {
        $this->stpResetAt = $stpResetAt;

        return $this;
    }
}