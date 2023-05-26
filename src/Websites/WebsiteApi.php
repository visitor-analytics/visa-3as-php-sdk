<?php

declare(strict_types=1);

namespace Visa\Websites;

use Visa\VisaHttpClient;

class WebsiteApi
{
    private string $intpWebsiteId;

    private VisaHttpClient $visaHttpClient;

    public function __construct(VisaHttpClient $visaHttpClient)
    {
        $this->visaHttpClient = $visaHttpClient;
    }

    public function setIntpWebsiteId(string $intpWebsiteId): WebsiteApi
    {
        $this->intpWebsiteId = $intpWebsiteId;

        return $this;
    }

    public function delete(): void
    {
        if (!$this->intpWebsiteId) {
            throw new \Exception('Website external id not set.');
        }

        $this->visaHttpClient->delete('/v2/3as/websites/' . $this->intpWebsiteId);
    }
}
