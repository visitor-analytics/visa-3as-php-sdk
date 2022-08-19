<?php

use PHPUnit\Framework\TestCase;

class VisitorAnalyticsTest extends TestCase
{
    public const PRIVATE_KEY = '';

    /**
     * @throws Exception
     */
    public function testBla()
    {
        $visa = new \Visa\VisitorAnalytics([
            'intp' => [
                'id' => '',
                'privateKey' => self::PRIVATE_KEY
            ],
            'env' => 'dev'
        ]);

        // UTILS API
//        print_r($visa->auth->generateINTPAccessToken());die;

        // PACKAGES API
//        print_r($visa->packages->list());die;
//        print_r($visa->packages->getById('f56ea59e-020b-4c7a-a5b9-f6b86aa5922a'));die;

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

//        print_r($visa->package('f56ea59e-020b-4c7a-a5b9-f6b86aa5922a')->update([
//            'name' => 'Basic'
//        ]));die;

        // CUSTOMERS API
//        print_r($visa->customers->list(['page' => 0, 'pageSize' => 100]));die;

//        print_r($visa->customers->create([
//            'intpCustomerId' => 'cf-0001',
//            'email' => 'cf-001@cf.com',
//            'website' => [
//                'intpWebsiteId' => 'intpc-ws-001',
//                'domain' => 'visa-3as-develop.io',
//                'packageId' => 'f56ea59e-020b-4c7a-a5b9-f6b86aa5922a'
//            ]
//        ]));die;

//        print_r($visa->customers->getByIntpCustomerId('cf-0001'));die;


        // CUSTOMER API
//        print_r($visa->customer('cf-0001')->listWebsites(['page' => 1, 'pageSize' => 10]));die;
//        print_r($visa->customer('cf-0001')->delete());die;
//        print_r($visa->customer('cf-0001')->generateIFrameDashboardUrl());die;

        // WEBSITES API
//        print_r($visa->websites->create([
//            'intpWebsiteId' => 'dssd-fdfd',
//            'intpCustomerId' => 'cf-0001',
//            'domain' => 'visa-3as-develop-ws-4.io',
//            'packageId' => 'f56ea59e-020b-4c7a-a5b9-f6b86aa5922a'
//        ]));die;

//        print_r($visa->websites->list(['page' => 0, 'pageSize' => 10]));die;
//        print_r($visa->websites->getByIntpWebsiteId('dssd-fdfd'));die;

        // WEBSITE API
//        print_r($visa->website('intpc-ws-001')->delete());die;

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
