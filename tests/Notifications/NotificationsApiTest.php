<?php

namespace Notifications;

use PHPUnit\Framework\TestCase;
use Visa\Notifications\NotificationsApi;
use Visa\VisaHttpClient;

class NotificationsApiTest extends TestCase
{
    public function testNotifyActionThrowsExceptionIfTypeIsNotPresent()
    {
        $httpClient = $this->createMock(VisaHttpClient::class);

        $notificationsApi = new NotificationsApi($httpClient);

        $this->expectExceptionMessage("{\"type\":\"type must be present\"}");

        $notificationsApi->notify(['payload' => []]);
    }

    public function testNotifyActionThrowsExceptionIfPayloadIsNotPresent()
    {
        $httpClient = $this->createMock(VisaHttpClient::class);

        $notificationsApi = new NotificationsApi($httpClient);

        $this->expectExceptionMessage("{\"payload\":\"payload must be present\"}");

        $notificationsApi->notify([
            'type' => 'SUBSCRIPTION_CREATED',
        ]);
    }

    public function testNotifyActionThrowsExceptionIfTypeIsNotSupported()
    {
        $httpClient = $this->createMock(VisaHttpClient::class);

        $notificationsApi = new NotificationsApi($httpClient);

        $this->expectExceptionMessage('{"type":"type must equal \"SUBSCRIPTION_UPDATED\""}');

        $notificationsApi->notify(['type' => 'INVALID_TYPE', 'payload' => []]);
    }

    public function testNotifyActionThrowsExceptionForInvalidSubscriptionCreatedPayload()
    {
        $httpClient = $this->createMock(VisaHttpClient::class);

        $notificationsApi = new NotificationsApi($httpClient);

        $this->expectExceptionMessage("{\"packageId\":\"packageId must be present\",\"website\":\"website must be present\",\"client\":\"client must be present\"}");

        $notificationsApi->notify(['type' => 'SUBSCRIPTION_CREATED', 'payload' => []]);
    }

    public function testNotifyActionCallsPostMethodForValidSubscriptionCreatedPayload()
    {
        $httpClient = $this->createMock(VisaHttpClient::class);
        $httpClient->expects($this->once())->method('post');

        $notificationsApi = new NotificationsApi($httpClient);

        $notificationsApi->notify([
            'type' => 'SUBSCRIPTION_CREATED',
            'payload' => [
                'packageId' => 'dd34de31-867d-492b-a87d-9057fc5c4180',
                'website' => [
                    'externalId' => 'EXTERNAL_ID',
                    'domain' => 'example.io',
                    'language' => 'en',
                    'timezone' => 'GMT+2',
                ],
                'client' => [
                    'externalId' => 'EXTERNAL_ID',
                    'email' => 'client@3as-company.io'
                ]
            ]
        ]);
    }

    public function testNotifyActionThrowsExceptionForInvalidSubscriptionUpdatedPayload()
    {
        $httpClient = $this->createMock(VisaHttpClient::class);

        $notificationsApi = new NotificationsApi($httpClient);

        $this->expectExceptionMessage("{\"packageId\":\"packageId must be present\",\"website\":\"website must be present\"}");

        $notificationsApi->notify(['type' => 'SUBSCRIPTION_UPDATED', 'payload' => []]);
    }

    public function testNotifyActionCallsPostMethodForValidSubscriptionUpdatedPayload()
    {
        $httpClient = $this->createMock(VisaHttpClient::class);
        $httpClient->expects($this->once())->method('post');

        $notificationsApi = new NotificationsApi($httpClient);

        $notificationsApi->notify([
            'type' => 'SUBSCRIPTION_UPDATED',
            'payload' => [
                'packageId' => 'dd34de31-867d-492b-a87d-9057fc5c4180',
                'website' => [
                    'id' => 'EXTERNAL_ID'
                ]
            ]
        ]);
    }
}
