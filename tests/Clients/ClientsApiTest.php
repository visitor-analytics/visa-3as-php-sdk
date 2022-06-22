<?php

namespace Clients;

use PHPUnit\Framework\TestCase;
use Visa\Clients\Client;
use Visa\Clients\ClientsApi;
use Visa\Response;
use Visa\VisaHttpClient;

class ClientsApiTest extends TestCase
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

        $clientsApi = new ClientsApi($httpClient);

        $this->assertIsArray($clientsApi->list());
        $this->assertInstanceOf(Client::class, $clientsApi->list()[0]);
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

        $clientsApi = new ClientsApi($httpClient);

        $this->assertInstanceOf(Client::class, $clientsApi->getById('64729b42-f50c-44f9-9edb-fdf13cc692e4'));
    }
}
