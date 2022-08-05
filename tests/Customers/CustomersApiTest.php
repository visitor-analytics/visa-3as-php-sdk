<?php

namespace Customers;

use PHPUnit\Framework\TestCase;
use Visa\Customers\Customer;
use Visa\Customers\CustomersApi;
use Visa\Response;
use Visa\VisaHttpClient;

class CustomersApiTest extends TestCase
{
    public function testListAction()
    {
        $response = $this->createMock(Response::class);
        $response->method('getPayload')
            ->willReturn([
                [
                    'id' => '64729b42-f50c-44f9-9edb-fdf13cc692e4',
                    'createdAt' => '2022-06-21T12:05:04+00:00'
                ]
            ]);

        $httpClient = $this->createMock(VisaHttpClient::class);
        $httpClient->method('get')
            ->willReturn($response);

        $customersApi = new CustomersApi($httpClient);

        $this->assertIsArray($customersApi->list());
        $this->assertInstanceOf(Customer::class, $customersApi->list()['items'][0]);
    }

    public function testGetByIdAction()
    {
        $response = $this->createMock(Response::class);
        $response->method('getPayload')
            ->willReturn([
                'id' => '64729b42-f50c-44f9-9edb-fdf13cc692e4',
                'createdAt' => '2022-06-21T12:05:04+00:00'
            ]);

        $httpClient = $this->createMock(VisaHttpClient::class);
        $httpClient->method('get')
            ->willReturn($response);

        $customersApi = new CustomersApi($httpClient);

        $this->assertInstanceOf(Customer::class, $customersApi->getByExternalId('64729b42-f50c-44f9-9edb-fdf13cc692e4'));
    }
}
