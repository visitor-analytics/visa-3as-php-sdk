<?php

declare(strict_types=1);

namespace Intpcs;

use PHPUnit\Framework\TestCase;
use Visa\Intpcs\IntpcApi;
use Visa\Response;
use Visa\Utils\AuthUtils;
use Visa\Utils\IFrameUtils;
use Visa\VisaHttpClient;

class CustomerApiTest extends TestCase
{
    public function testListWebsitesAction()
    {
        $intp = [
            'id' => 'abc',
            'privateKey' => 'xyz',
            'env' => 'development'
        ];

        $response = $this->createMock(Response::class);
        $response->method('getPayload')
            ->willReturn([
                [
                    'id' => '59b763f4-cd5e-41fc-8d29-520576e46322',
                    'domain' => 'https://example.io',
                    'createdAt' => '2022-06-21T12:05:04+00:00'
                ]
            ]);

        $httpClient = $this->createMock(VisaHttpClient::class);
        $httpClient->method('get')
            ->willReturn($response);

        $customerApi = new IntpcApi($httpClient, new IFrameUtils(new AuthUtils($intp), 'dev'));

        $this->assertIsArray(
            $customerApi->setIntpcId('f653a5c5-842e-4f8f-a25d-e86c1122a341')
            ->listWebsites()
        );
    }
}
