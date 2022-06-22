<?php

namespace Websites;

use PHPUnit\Framework\TestCase;
use Visa\Response;
use Visa\VisaHttpClient;
use Visa\Websites\Website;
use Visa\Websites\WebsitesApi;

class WebsitesApiTest extends TestCase
{
    public function testListAction()
    {
        $response = $this->createMock(Response::class);
        $response->method('getPayload')->willReturn([
            [
                'id' => '9e595bdc-b79c-4c32-9d2f-80be6a67785c',
                'domain' => 'https://example.io',
                'createdAt' => '2022-06-21T12:05:04+00:00'
            ]
        ]);

        $httpClient = $this->createMock(VisaHttpClient::class);
        $httpClient->method('get')
            ->willReturn($response);

        $websiteApi = new WebsitesApi($httpClient);

        $this->assertIsArray($websiteApi->list());
        $this->assertInstanceOf(Website::class, $websiteApi->list()[0]);
    }

    public function testGetByIdAction()
    {
        $response = $this->createMock(Response::class);
        $response->method('getPayload')->willReturn([
            'id' => '9e595bdc-b79c-4c32-9d2f-80be6a67785c',
            'domain' => 'https://example.io',
            'createdAt' => '2022-06-21T12:05:04+00:00'
        ]);

        $httpClient = $this->createMock(VisaHttpClient::class);
        $httpClient->method('get')
            ->willReturn($response);

        $websiteApi = new WebsitesApi($httpClient);

        $this->assertInstanceOf(
            Website::class,
            $websiteApi->getById('9e595bdc-b79c-4c32-9d2f-80be6a67785c')
        );
    }
}
