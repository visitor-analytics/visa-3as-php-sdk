<?php

declare(strict_types=1);

namespace Visa\Models;

class Package
{
    private string $id;
    private string $name;
    private int $touchpoints;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getTouchpoints(): int
    {
        return $this->touchpoints;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
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
}
