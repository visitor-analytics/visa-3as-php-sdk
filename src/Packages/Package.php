<?php

declare(strict_types=1);

namespace Visa\Packages;

class Package
{
    private string $id;
    private string $name;
    private float $price;
    private string $currency;
    private int $touchpoints;
    private string $period;
    private bool $recommended;
    private string $intpId;
    private string $createdAt;

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
    public function getIntpId(): string
    {
        return $this->intpId;
    }

    /**
     * @param string $intpId
     */
    public function setIntpId($intpId)
    {
        $this->intpId = $intpId;
    }

    /**
     * @return bool
     */
    public function isRecommended()
    {
        return $this->recommended;
    }

    /**
     * @return bool
     */
    public function getRecommended()
    {
        return $this->recommended;
    }

    /**
     * @param bool $recommended
     */
    public function setRecommended($recommended)
    {
        $this->recommended = $recommended;
    }

    /**
     * @return string
     */
    public function getPeriod(): string
    {
        return $this->period;
    }

    /**
     * @param string $period
     */
    public function setPeriod(string $period): void
    {
        $this->period = $period;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }

    /**
     * @return int
     */
    public function getTouchpoints(): int
    {
        return $this->touchpoints;
    }

    /**
     * @param int $touchpoints
     */
    public function setTouchpoints(int $touchpoints): void
    {
        $this->touchpoints = $touchpoints;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string $createdAt
     */
    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}
