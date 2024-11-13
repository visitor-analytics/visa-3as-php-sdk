<?php

declare(strict_types=1);

namespace Visa\Websites;

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator;
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

    public function addWhitelistedDomain(string $domain): void
    {
        if (!$this->intpWebsiteId) {
            throw new \Exception('Website external id not set.');
        }

        try {
            $this->visaHttpClient->post('/v2/3as/websites/' . $this->intpWebsiteId . '/whitelisted-domains', ['domain' => $domain]);
        } catch (NestedValidationException $exception) {
            throw new \Exception(json_encode($exception->getMessages()));
        }
    }

    public function deleteWhitelistedDomain(string $domain): void
    {
        if (!$this->intpWebsiteId) {
            throw new \Exception('Website external id not set.');
        }

        try {
            $this->visaHttpClient->delete('/v2/3as/websites/' . $this->intpWebsiteId . '/whitelisted-domains/' . urlencode($domain));
        } catch (NestedValidationException $exception) {
            throw new \Exception(json_encode($exception->getMessages()));
        }
    }

    /**
     * @return string[] An array of domains
     * @throws \Exception
     */
    public function listWhitelistedDomains(): array
    {
        if (!$this->intpWebsiteId) {
            throw new \Exception('Website external id not set.');
        }

        try {
            $response = $this->visaHttpClient->get('/v2/3as/websites/' . $this->intpWebsiteId . '/whitelisted-domains');
            return $response->getPayload();
        } catch (NestedValidationException $exception) {
            throw new \Exception(json_encode($exception->getMessages()));
        }
    }
}
