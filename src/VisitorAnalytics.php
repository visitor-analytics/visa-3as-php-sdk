<?php

declare(strict_types=1);

namespace Visa;

use GuzzleHttp\Exception\GuzzleException;
use Visa\Models\Package;

class VisitorAnalytics
{
    private Client $client;

    public Packages $visaPackages;

    /**
     * @throws \Exception
     */
    public function __construct(array $params)
    {
        $this->client = new Client([
            'host' => 'http://localhost:8080',
            'company' => $params['company']
        ]);

        $this->visaPackages = new Packages($this->client);
    }

    /**
     * @throws GuzzleException
     */
    public function packages(array $criteria = []): array
    {
        return $this->visaPackages->getMany($criteria);
    }

    /**
     * @throws GuzzleException
     */
    public function package(string $id): Package
    {
        return $this->visaPackages->get($id);
    }
}
