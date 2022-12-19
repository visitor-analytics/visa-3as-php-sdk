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
    private bool $trial;
    private bool $recommended;
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
     * @return bool
     */
    public function isRecommended(): bool
    {
        return $this->recommended;
    }

    /**
     * @param bool $recommended
     */
    public function setRecommended(bool $recommended): void
    {
        $this->recommended = $recommended;
    }

    /**
     * @return bool
     */
    public function isTrial(): bool
    {
        return $this->trial;
    }

    /**
     * @param bool $trial
     */
    public function setTrial(bool $trial): void
    {
        $this->trial = $trial;
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
