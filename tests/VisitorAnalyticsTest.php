<?php

use PHPUnit\Framework\TestCase;

class VisitorAnalyticsTest extends TestCase
{
    public const PRIVATE_KEY = '-----BEGIN PRIVATE KEY-----
MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQDAgNASOhayPrDm
WwOESdbS3mMb0vUZALFHCw49dc2zSXHs4mlDQtQe2FT0urzEZvM22Dgog1IbmbtW
zRGOulHgPHwQDu4A85l18Goko+hjk/oriZn5e6pL/vtc2dc15QDrVl0zNp1AT87/
1vyn30lCVpM7ptoI1Hg/blQo0DIzGes0R9Vu2v7SOlsqR5lIPEjCtmNJKySYn/e9
zDQPqnMu4KOhQ5wDnaO+gg2GRgIqZRbCzWqUoclrsj6ByubESRCtkg0S25OY5OZR
wivVM1kKOrSCt9xcVNRRUjOXUMUxXiJrUhrkWG8CMzvubfKawOhqUFRYPt/33GR3
FrNGucqjAgMBAAECggEAIo08S3k3p6iO8dm2KOFj+JdH7K+RpHo2V40JckiZsitl
kmIVCKiPEDY+EWsPBKWB0/89HTBs5V1TfcHy+84/ceMJVYyIdY1DpyKOuqLczDq8
NWJOS7RBncBXd5P2B8thvdvTgKS11tw8SDlbQfpW2NxXMubAzcLtDl2MJ4Mu73LQ
JUuuTol/+7RmfSMW+r8mEp/n/3QiPMwrzeISBXXYQ4+bIwtvX/x3Uup3bd0P2QhE
CMPntdP6O+lRa25pc1zjnoAn7F/Mgk8tj/xv2fn4Zf4J/aPrEF4xG5cnXdYhuqtO
IS8HtnI1aXeHCO6JVfX4TM8erc6jcpTTsvpX2ZEYEQKBgQD8hITBO32G3V/tcnRI
YcEvkB9X0hS6N6iV716eyluYX4LnWMM1JibxfkjbPl1C6h9gOvpAke8yJjCapvlb
nMRWtLWrZBlJ6wouuKx8LfXs24oFo/FOAhOz/hgspFz3O/lbpyQrFTjhRoMsWC3W
+mWG1EK0FVgRVAbOcj4uLm8NOwKBgQDDKGu1X7Nr9eO3nTJPRYoeco1pc9H6Jc4g
tio02TELkop8suk0PB116kN2C09St1YIr5DR1QB1R6YhMbj0Kp+J/2ULgsKHnV1d
O9nzJ1HqUovcNbitd7dVWEqy2z3PB3/2hpulptHRmQU1jbqFFG9apgSrtdkA+S72
EGEb9YQBuQKBgQCCJv+R5UrO331ZEpwSzqfXDw7IohRi4ts25Ji9eYl6YQhEm8CJ
vW9nG3ML5foFykx/ugZQj6ddDsgQfi2aZZPhKOVWQJK0QbwO1sq4eqv9+C4MuDJg
xbtIE5h8Mf9kwvnEnsKKnjaiDkj/6zc9TfRUaUU0MqggzlFvyPx5qx88DwKBgAyE
z0P3O581SsJAhzWmlFGXr5KQJ2wQeMSIavSw6gCACfotz9/V613hBSrRVulLcW1l
NbkAHONpETMX6XFgOpOzmlu+q5PfeFm+uSBr6UlKukYJ/CrEfzIuU7xda/2X0ZGS
2PErXlI/qqHg0ZIv2WTLOYl6RM1XLrgCHPiaKzmhAoGBAIXxtNElRnmfYkpTFVl1
+WCfN3nUIEZXpfl4lwm6sTUQKf9YjWTpWZAmKTjw/3mdMC0CoCrfZ8hzuGAYRPiR
+N7lBTyXHD3Q6htNlwITpRzKqLiqgQX0sgxlFN8Xo+nlmRotj0Q9GkTgOPWP1VOc
Tx7R8qNqe+5pKGQMkdANaIRU
-----END PRIVATE KEY-----';

    /**
     * @throws Exception
     */
    public function testBla()
    {
        $visa = new \Visa\VisitorAnalytics([
            'intp' => [
                'id' => 'bf4eb249-953e-4bc3-ab7e-890562c800ed',
                'privateKey' => self::PRIVATE_KEY
            ],
            'env' => 'dev'
        ]);

        // UTILS API
//        print_r($visa->auth->generateINTPAccessToken());die;

        // PACKAGES API
        print_r($visa->packages->list());die;
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
        print_r($visa->customer('cf-0001')->listWebsites(['page' => 1, 'pageSize' => 10]));die;
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
        $visa->notifications->notify([
            'type' => 'SUBSCRIPTION_CREATED',
            'payload' => [
                'packageId' => 'f56ea59e-020b-4c7a-a5b9-f6b86aa5922a',
                'website' => [
                    'intpWebsiteId' => 'xafsdjf-12312-sad-123',
                    'domain' => 'visa-3as-develop-website-20.io',
                    'language' => 'en',
                    'timezone' => 'GMT+2'
                ],
                'client' => [
                    'intpCustomerId' => 'cf-0001',
                    'email' => 'dfsd@f111.com'
                ]
            ]
        ]);
    }
}
