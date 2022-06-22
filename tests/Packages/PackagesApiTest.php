<?php

declare(strict_types=1);

namespace Packages;

use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;
use Visa\Packages\PackagesApi;
use Visa\Response;
use Visa\VisaHttpClient;
use Visa\Packages\Package;

class PackagesApiTest extends TestCase
{
    /**
     * @throws GuzzleException
     */
    public function testListPackagesAction()
    {
        $response = $this->createMock(Response::class);
        $response->method('getPayload')->willReturn([
            [
                'id' => '5e392d13-5db2-40c0-a3db-03c37ad365b4',
                'name' => 'Basic',
                'touchpoints' => 1500,
                'createdAt' => '2022-06-20T07:48:07+00:00'
            ]
        ]);

        $client = $this->createMock(VisaHttpClient::class);
        $client->method('get')
            ->willReturn($response);

        $packagesApi = new PackagesApi($client);

        $packages = $packagesApi->list();

        $this->assertIsArray($packages);
        $this->assertInstanceOf(Package::class, $packages[0]);
    }

    public function testGetByIdAction()
    {
        $response = $this->createMock(Response::class);
        $response->method('getPayload')->willReturn(
            [
                'id' => '5e392d13-5db2-40c0-a3db-03c37ad365b4',
                'name' => 'Basic',
                'touchpoints' => 1500,
                'createdAt' => '2022-06-20T07:48:07+00:00'
            ]
        );

        $httpClient = $this->createMock(VisaHttpClient::class);
        $httpClient->method('get')
            ->willReturn($response);

        $packagesApi = new PackagesApi($httpClient);

        $package = $packagesApi->getById('5e392d13-5db2-40c0-a3db-03c37ad365b4');

        $this->assertInstanceOf(Package::class, $package);
    }
}
