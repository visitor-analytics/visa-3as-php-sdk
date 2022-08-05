<?php

use PHPUnit\Framework\TestCase;

class VisitorAnalyticsTest extends TestCase
{
    public const PRIVATE_KEY = '-----BEGIN PRIVATE KEY-----
MIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQCItOzcdCofNNTQ
4o+ISxCA6Vo1ItZUVLh7Ne1+NMDss3yjgN12TdgzEYnfcSG0YKOabtCnStCnIo50
NDJKqwdetp9tvmsJHQDcvwzUOdOJMTw4Dyxd/0ycrMcHbOXPTEHLgMHmu2sIuvPP
4G6DCxV1QcgzNP12SOQrnY+E40A96lW3xH3S5QC3+B2eUuaR+z31Ac1Rr4YUUP3q
NZ1WxMxBN0vZ3WiyRnb++cy38y/YKNC7xqWvuZF26aiEtAmFHx1300VDtHpNq9v5
wSBRKx+rxzWzMQqDuePxzRVuPoaTnZkDUWcjajElKt3odmJzTlVl6W42ctKYcKvP
0kOkD8lfAgMBAAECggEANwxTzLniNEq735k7nvBLJv3QW1E56R9sYgDnL0ji3u2v
pM9BXmAeTQIk+Jq/rbi0aH1y+8p+lq6tmlFiZvrTrunu7Owegb7yF/G+or7eVYJD
83b4sKkbGoPgaTcKmxzj6aRhcB3MDenqP6zqE06lR2BD04rk/XqAlqeNoT85ITTe
QS5BtvCw5yUdzrfdjQLhlA710K4DHr7vb0nSUHGV9KMhgCkW/lAjvTATywQyt0bL
xrvjSrAy6N0POegLIWefBFTOQp7BRiBB99TfJ7RqP6V5Aoj8Kps9WOdpcHrPQ2Pj
HRcGmydMV2DtfiXKn9mQutX14zf6QIiFzJNUIZyh8QKBgQDuvlTcQGWBXQIgbWdq
bvNTcg6tFDimOqhiP6p+Xs1h5hRRdVwGMZMdVtv9g6Ktnf+xxQFIa74Vaulu5Ucq
I2yyx+ZxU3ToaZOnUNa1FBFXkAR1DCWvJv4A+KAmyizj0zfVPWI6cCVZx/5es3y4
1u1U/2zmaERFrn12bMt0RdGtgwKBgQCSloX5BYsyrtoUqxLT/yxTmWRLfTMCufTV
f89DHFNQw3daW7X9aI3stKHOZfZkbpF4Y5iV/UUE85MwYNz7icrH2keju1m+Rcja
gEz3xqj2sLn/Bw+3ImFwMaUyi+R418PROmsS/egWruYtnTS2a0+rq8f5nw6y25rf
CloN2b5p9QKBgFMLCWGDVMtmmrLE20/+P80qw0gY3IuVo7RpCNjkCPSgnzimZdgR
rmZqLCNGgnN5ndMr/4I9V+UDRyc3wUU7BTg6qEGLEgM1lhKA3+4kiNO4WJSOIR2H
ppqX4L0dXffxJF6b92r0T0mncydlr2BsAimqnyqV4gmK5EEpHqvXDVQZAoGAOeJU
fvQQdnATT6wKIEqYH17n+uMyfHYf1xrEJlUOFUtKWxTx9WIPARSG/HDI7fm3WdnC
TCAZ3A2u5qCpQm6z810fgukdVARMfvPA8Oqyl89Lcwg/zWo3Hc2M1TvmeU2CVqGB
3JsExchEvmhgg1Q2vqxzp/+GF1yeeEqnKub7yO0CgYAw3Yx1C/FI7Oe72QGKkiuh
EyEZWEpSC701rQw6HicafiXvoLghxBB0G2JhzeKg/TUUv3QnhpgSZ+lwbT1HoMoT
sWasdeA8o5UQdcNEdly3IKk2fZY5YJ4YVRgTYpahZiWuodpJ8mTBm2yQaqxkIW2k
1vCtete+gEXyRnh/Lyo5/A==
-----END PRIVATE KEY-----';

    /**
     * @throws Exception
     */
    public function testBla()
    {
        $visa = new \Visa\VisitorAnalytics([
            'intp' => [
                'id' => '56ef8b3c-c213-43a8-9f77-94a1407cb63a',
                'domain' => 'visa-3as-develop.io',
                'privateKey' => self::PRIVATE_KEY
            ],
            'env' => 'dev'
        ]);

        // UTILS API
//        print_r($visa->auth->generateINTPAccessToken());die;
//        print_r($visa->utils->auth->generateINTPcAccessToken());die;
//        print_r($visa->iframe->generateDashboardUri('aci'));


        // PACKAGES API
//        print_r($visa->packages->list());die;
//        print_r($visa->packages->getById('56d4deaa-5cb7-4061-9e2c-a310748573db'));die;

//        print_r($visa->packages->create([
//            'name' => 'Advanced',
//            'touchpoints' => 5000
//        ]));die;

//        print_r($visa->package('2f96252f-ac6e-430f-bdc7-dd00b8609740')->update([
//            'name' => 'APAV'
//        ]));die;

        // CLIENTS API
//        print_r($visa->customers->list());die;
//        print_r($visa->customers->getByExternalId('intpc-0001'));die;

//        print_r($visa->customers->create([
//            'externalId' => 'intpc-0001',
//            'email' => 'dev-3as-intpc-0001@develop.com',
//            'website' => [
//                'externalId' => 'intpc-ws-001',
//                'domain' => 'visa-3as-develop.io',
//                'packageId' => '56d4deaa-5cb7-4061-9e2c-a310748573db'
//            ]
//        ]));die;

//        print_r($visa->customers->getByExternalId('intpc-0001'));die;


        // CLIENT API
//        print_r($visa->customer('intpc-0001')->listWebsites());die;
//        print_r($visa->customer('abc')->delete());

        // WEBSITES API
//        print_r($visa->websites->create([
//            'externalId' => 'intpc-ws-003',
//            'externalCustomerId' => 'intpc-0001',
//            'domain' => 'visa-3as-develop-ws-3.io',
//            'packageId' => '56d4deaa-5cb7-4061-9e2c-a310748573db'
//        ]));die;

//        print_r($visa->websites->list(['page' => 0, 'pageSize' => 3]));die;
//        print_r($visa->websites->getByExternalId('fsdfdfds3-as-343-12'));die;

        // WEBSITE API
//        print_r($visa->website('fsdfdfds3-as-343-12')->delete());die;

        // NOTIFICATIONS API
//        $visa->notifications->notify([
//            'type' => 'SUBSCRIPTION_CREATED',
//            'payload' => [
//                'packageId' => '2f96252f-ac6e-430f-bdc7-dd00b8609740',
//                'website' => [
//                    'externalId' => 'xafsdjf-12312-sad-123',
//                    'domain' => 'visa-3as-develop-website-2.io',
//                    'language' => 'en',
//                    'timezone' => 'GMT+2'
//                ],
//                'client' => [
//                    'externalId' => 'a222asfdfddf-12',
//                    'email' => 'dfsd@f111.com'
//                ]
//            ]
//        ]);
    }
}
