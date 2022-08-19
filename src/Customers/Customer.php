<?php

declare(strict_types=1);

namespace Visa\Customers;

class Customer
{
    private string $id;
    private string $intpCustomerId;
    private string $visaId;
    private string $email;
    private string $intpId;
    private string $createdAt;

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getVisaId(): string
    {
        return $this->visaId;
    }

    /**
     * @param string $visaId
     */
    public function setVisaId(string $visaId): void
    {
        $this->visaId = $visaId;
    }

    /**
     * @return string
     */
    public function getIntpCustomerId(): string
    {
        return $this->intpCustomerId;
    }

    /**
     * @param string $intpCustomerId
     */
    public function setIntpCustomerId(string $intpCustomerId): void
    {
        $this->intpCustomerId = $intpCustomerId;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
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
    public function setIntpId(string $intpId): void
    {
        $this->intpId = $intpId;
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
}
