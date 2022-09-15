<?php

use PHPUnit\Framework\TestCase;

class VisitorAnalyticsTest extends TestCase
{
    public const PRIVATE_KEY = '-----BEGIN PRIVATE KEY-----
MIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQCEuiQbjbI7IBcT
G95DXPZ8MTXHt7rpBTgJgtTJz/NgAu2FbTeNTFTYrK4Ifgu/tDVHKohkludaC+QF
pBqQRdkfr43DFGBUFuaIc8zjHDUrA5fmacfCt0GaQSFxN9hStx1lO/PZ8k9vF4Vr
SbwIrqbd9ZDU6JddEMbC5pC3sdfhsj6YeGs8D7J6wptru7qWUYyueQ0M9+Y8WthF
nnpou9f2pHtmTjLB0iL6qIL/sS3WGPahfbyqzJwredaJYkbKQwi6jYqPDvtkF4C2
EbIcahQzepG7B1aPnXb4UKXj+bY8a7uBsGpvylsGILGYZzH8nnNJ+64ZvlPUwpGA
KZJ1XMcXAgMBAAECggEATmqrapwM8WHEQEX2y1XhSv7IB3dFtuaedQAXOCTkZZVV
P7+HUrQGbP2Y1OujhV+zGpjGfKeriEf+MFcEWrjpzw6pcthXEVd2XKgOJSBFSWSW
Gkvk+eXLnJdeasXTyQrnEyiYqeu/gqMi8IBf18FYVUsAhsnko9eFlyEh32XzZiRK
/00o+AI4j7oJba8A7s48LaSaLVRaxHr36zlFPkdIH5JKa98PQAla7lxwJLKZua2P
M9QgLQndCMP6qW1AUGcap+l3VtsXoE40Ffblp6Z8dPaQWcNI/zJYwPRB5AAFcjYQ
D9nKqtVo+MpZciozIO3LGs3IfRj2zJLytYVGn5weAQKBgQDh9FQNy2ikBpc+w2ep
bLyHPPU+4lCLsn+FAZMHJibrzoFX7QbW530y7UlsMVj66BVbXyB+sjnlKPvqscyV
acJypyrVhRg0ILJOiFfkj6E1zIiKczM2m7d4orpYvNSPc3g9NyRwdw564J2vv4TC
3VzLdyx9yJSx8y+JtubGQYvgzQKBgQCWYEekflSlZXK01M7kiRyQrxOfFFe/7ZL9
9kjohp/hvpnDbtlf4PB5oK5wFMd+zWJUzBMPavdbEKkPFfIVrUDUmerAdiqEb/+B
6b03jmWdeus5Gmw5v3Wz8hAlo/V8WbHkOp0mXuv7jojPhDt4W4xCotR0yzqjU1Wu
Bj8D0CX3cwKBgEkj66ljdIXT1FVurzl6hzRHmSM34ta1eu206sDfqq2d9ORfR119
JVu8z42EE8d0JKWlD0Gzs2XodFMuJoke6OBwGD9xi7oj81PUco77pzVg9bnLPIKq
uSMFmchrp2qf+AXouZTmFPvVhXWESxdAzG7YLsCwkuFfVL4BRIZcZUjpAoGAQsxS
Bsf3YeFGqv09Sld90Od0l925fRBTk2yrxl7G9shsFVxQQz7wk5bE5hTU6YbifziH
3vltF463CnR9LRPhEI+ur//NszbtERB7dQpUKThI9Py/xoc+CcklUxMaITrWwsMm
u7y+pugR7dyXbkd8br1WEuuUCKkkDkHIDDGSK/ECgYBmpOHBc3oA3/5EmkouqUaG
SOwLDyEKIchpC1a/tFBqGl2bCW3QnORX4ihpqybDneDti5bzWKTgZBRq5oAMwPuk
0q4+pGVthf43X31CNwu9UeVvhek7oH9iLl4dGG+NCogCC5R/TH1EMwFLuDOzgGyq
rn1iADcyL3ZX75/vG8TFLA==
-----END PRIVATE KEY-----';

    /**
     * @throws Exception
     */
    public function testBla()
    {
        $visa = new \Visa\VisitorAnalytics([
            'intp' => [
                'id' => 'a078c06b-3301-44e4-a650-2725539456f6',
                'privateKey' => self::PRIVATE_KEY
            ],
            'env' => 'dev'
        ]);

        // UTILS API
//        print_r($visa->auth->generateINTPAccessToken());die;

        // PACKAGES API
//        print_r($visa->packages->list());die;
        // print_r($visa->packages->getById('5ecff82d-c391-48e6-9205-b96818aa25ff'));die;

        // FREE
//        print_r($visa->packages->create([
//            'name' => 'Free',
//            'touchpoints' => 400,
//            'price' => 0.0,
//            'currency' => 'EUR'
//        ]));die;

        // BASIC
//        print_r($visa->packages->create([
//            'name' => 'Basic',
//            'touchpoints' => 10000,
//            'price' => 12.99,
//            'currency' => 'EUR'
//        ]));die;

        // ADVANCED
//        print_r($visa->packages->create([
//            'name' => 'Advanced',
//            'touchpoints' => 25000,
//            'price' => 28.99,
//            'currency' => 'EUR'
//        ]));die;

//        print_r($visa->package('5ecff82d-c391-48e6-9205-b96818aa25ff')->update([
//            'name' => 'Basic'
//        ]));die;

        // CUSTOMERS API
//        print_r($visa->customers->list(['page' => 0, 'pageSize' => 100]));die;

//        print_r($visa->customers->create([
//            'intpCustomerId' => 'x-1',
//            'email' => 'x-232@x.com',
//            'website' => [
//                'intpWebsiteId' => 'intpc-ws-001',
//                'domain' => 'visa-3as-develop.io',
//                'packageId' => '5ecff82d-c391-48e6-9205-b96818aa25ff'
//            ]
//        ]));die;

//        print_r($visa->customers->getByIntpCustomerId('x-1'));die;


        // CUSTOMER API
//        print_r($visa->customer('x-1')->listWebsites(['page' => 0, 'pageSize' => 10]));die;
//        print_r($visa->customer('cf-0001')->delete());die;
//        print_r($visa->customer('cf-0001')->generateIFrameDashboardUrl("intpc-ws-001"));die;

        // WEBSITES API
//        print_r($visa->websites->create([
//            'intpWebsiteId' => 'dssd-fdfd',
//            'intpCustomerId' => 'x-1',
//            'domain' => 'visa-3as-develop-ws-4.io',
//            'packageId' => '5ecff82d-c391-48e6-9205-b96818aa25ff'
//        ]));die;

//        print_r($visa->websites->list(['page' => 0, 'pageSize' => 10]));die;
//        print_r($visa->websites->getByIntpWebsiteId('intpc-ws-001'));die;

        // WEBSITE API
//        print_r($visa->website('dssd-fdfd')->delete());die;

        // NOTIFICATIONS API
//        $visa->notifications->notify([
//            'type' => 'SUBSCRIPTION_CREATED',
//            'payload' => [
//                'packageId' => 'f56ea59e-020b-4c7a-a5b9-f6b86aa5922a',
//                'website' => [
//                    'intpWebsiteId' => 'xafsdjf-12312-sad-123',
//                    'domain' => 'visa-3as-develop-website-20.io',
//                    'language' => 'en',
//                    'timezone' => 'GMT+2'
//                ],
//                'client' => [
//                    'intpCustomerId' => 'cf-0001',
//                    'email' => 'dfsd@f111.com'
//                ]
//            ]
//        ]);
    }
}
