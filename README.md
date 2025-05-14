# TWIPLA PHP SDK

A simple API wrapper for integrating the Analysis as a Service (3AS) APIs provided by TWIPLA

## Getting started

1. [Create an RSA Key Pair (PEM format)](#creating-an-rsa-key-pair)
1. Send the resulting public key (`jwtRS256.key.pub`) to the TWIPLA Dev Team
1. [Install the library](#installation)
1. [Use the SDK instance](#how-to-use-the-library) to interract with the API

## Creating an RSA Key pair

1. Create the keypair: `ssh-keygen -t rsa -b 2048 -m PEM -f jwtRS256.key`
1. Convert the public key to PEM: `openssl rsa -in jwtRS256.key -pubout -outform PEM -out jwtRS256.key.pub`

## Installation

### Composer

#### Install via Composer

```
composer require visitor-analytics/3as-sdk
```

## How to use the library

```php
$visa = new VisitorAnalytics([
     'intp' => [
         'id' => {INTP_ID},
         'privateKey' => {INTP_RS256_PRIVATE_KEY}
     ],
     'env' => 'stage'
]);
```

## Concepts

### Terms

- **INTP (Integration Partner)**\
   The company that is integrating the analytics as a service solution (3AS)
- **STPs (Server Touchpoints)**\
   Credits used to measure data usage for a given website
- **Intpc (INTPC integration partner customer)**\
   One user of the INTP, can have many websites
- **Website**\
   The website where data will be tracked. It has a subscription with a package with a certain limit of STPs.
  This subscription can be upgraded or downgraded.
  When the website is created a tracking code snippet is returned that must be embedded within the websites HTML.
- **Package**\
   A package has a price and contains a certain number of STPs. They are used when upgrading/downgrading the subscription of a website.

### General

Most endpoints that deal with customers or websites support some form of an ID which can be provided and then used for all following requests.

For example creating a new customer with a website requires an `intpCustomerId`|`intpcId` and an `intpWebsiteId`. These must be provided by the INTP and are intended to make integrations easier because there is no need to save any external IDs. Then when getting data about a customer the request is done using the same `intpCustomerId` provided on creation.

**Example implementation flow**

1. Create a new intpc with a website
1. Inject the resulting tracking code in the website's HTML
1. Use the SDK's [generate iframe url](#generate-the-visitoranalytics-dashboard-iframe-url) method to create an url
1. Show an iframe to the user with the url created previously
1. Show a modal to the user to upgrade his subscription
1. Display all the available packages using the SDK
1. After the payment is complete, use the SDK to upgrade the subscription of the website

## Available APIs

- [INTPCs](#customers-api)
- [INTPC](#customer-api)
- [Package](#package-api)
- [Packages](#packages-api)
- [Website](#website-api)
- [Websites](#websites-api)
- [Utils](#utils-api)

### INTPc API

Integration partners (INTP) are able to get data about their customers (INTPc).

#### Register and start an INTPc level subscription. This will allow subsequently added websites to consume from the same `touchpoint` pool provided by the `package` used during setup.

```php
$visa->intpcs->create([
        'intpCustomerId' => {INTP_CUSTOMER_ID},
        'email' => {INTP_CUSTOMER_EMAIL},
        'packageId' => {PACKAGE_UUID},
        'billingDate' => {ISO_DATE_STRING} (optional, defaults to current time)
        'website' => [
            'intpWebsiteId' => {INTP_WEBSITE_ID},
            'domain' => {INTP_WEBSITE_DOMAIN_URI},
        ]
]);
```

#### Register an INTPc and start a website level subscription. Each added website will have its own subscription.

```php
$visa->intpcs->create([
        'intpCustomerId' => {INTP_CUSTOMER_ID},
        'email' => {INTP_CUSTOMER_EMAIL},
        'website' => [
            'intpWebsiteId' => {INTP_WEBSITE_ID},
            'domain' => {INTP_WEBSITE_DOMAIN_URI},
            'packageId' => {PACKAGE_UUID},
            'billingDate' => {ISO_DATE_STRING} (optional, defaults to current time)
        ]
]);
```

#### List all available customers

```php
$visa->intpcs->list();
```

#### Get a single intpc by its INTP given id

```php
$visa->intpcs->getByIntpCustomerId({INTP_CUSTOMER_ID});
```

### INTPC API

#### List all websites belonging to an INTP Customer

```php
$visa->intpc({INTP_CUSTOMER_ID})->listWebsites();
```

#### Delete a Customer belonging to an INTP

```php
$visa->intpc({INTP_CUSTOMER_ID})->delete();
```

#### Generate the VisitorAnalytics Dashboard IFrame Url

This is one of the essential methods to use when using the iframe appoach 3AS.
It creates an URL for a given customer and website combination that shows the TWIPLA dashboard in the theme configured by the INTP.

```php
$visa->intpc({INTP_CUSTOMER_ID})->generateIFrameDashboardUrl({INTP_WEBSITE_ID});
```

### Packages API

An Integration Partner (INTP) is able to get data about their packages

#### List all available packages

```php
$visa->packages->list();
```

#### Get a single package by ID

```php
$visa->packages->getById({PACKAGE_UUID});
```

#### Create a package

```php
$visa->packages->create([
    'name' => {PACKAGE_NAME},
    'touchpoints' => {TOUCHPOINT_LIMIT},
    'price' => {FLOAT},
    'currency' => {CURRENCY_CODE}, // ex: EUR, USD, RON
    'period' => {PERIOD}, // ex: monthly, yearly
]);
```

### Package API

#### An INTP can update its packages

```php
$visa->package({PACKAGE_UUID})->update([
    'name' => {UPDATED_PACKAGE_NAME}
]);
```

### Websites API

#### List all websites

```php
$visa->websites->list();
```

#### Get a single website by its INTP given id

```php
$visa->websites->getByIntpWebsiteId({INTP_WEBSITE_ID});
```

#### Create a website with its own subscription and attach it to an existing INTPc

```php
$visa->websites->create([
    'website' => [
        'id' => {INTP_WEBSITE_ID|STRING}},
        'domain' => {INTP_WEBSITE_DOMAIN},
        'package' => [
            'id' => {UUID}
            'billingDate' => {ISO_DATE_STRING} (optional, defaults to current time)
        ]
    ],
    'intpc' => [
        'id' => {INTP_CUSTOMER_ID|STRING}
    ],
]);
```

#### Create a website and attach it to an existing INTPc subscription. This website, alongside other pre-existing website will consume `touchpoints` from the same pool.

```php
$visa->websites->create([
    'website' => [
        'id' => {INTP_WEBSITE_ID|STRING}},
        'domain' => {INTP_WEBSITE_DOMAIN},
    ],
    'intpc' => [
        'id' => {INTP_CUSTOMER_ID|STRING}
    ],
]);
```

#### Create a website with its own `30 day, unlimited free trial` subscription and attach it to an INTPc. After the 30 day free trial ends, the subscription will be downgraded to the `free` package.

```php
$visa->websites->create([
    'website' => [
        'id' => {INTP_WEBSITE_ID|STRING}},
        'domain' => {INTP_WEBSITE_DOMAIN},
    ],
    'intpc' => [
        'id' => {INTP_CUSTOMER_ID|STRING}
    ],
    'opts' => [
        'uft' => true
    ]
]);
```

<br>

### Website API

#### Delete a website by its INTP given id

```php
$visa->website({INTP_WEBSITE_ID})->delete());
```

#### Add a whitelisted domain

```php
visa->website({INTP_WEBSITE_ID})->addWhitelistedDomain(STRING);
```

#### Delete a whitelisted domain

```php
visa->website({INTP_WEBSITE_ID})->deleteWhitelistedDomain(STRING);
```

#### List all whitelisted domains

```php
visa->website({INTP_WEBSITE_ID})->listWhitelistedDomains();
```

### API for managing a subscription of type `website`

#### Upgrade - immediately applies a higher stp count package to the subscription

```php
$visa->websiteSubscription->upgrade([
    "intpWebsiteId" => {INTP_WEBSITE_ID},
    "packageId" => {PACKAGE_UUID},
    "trial" => {true|false},
    "proRate" => {true|false}
])
```

#### Downgrade - auto-renew the subscription at the end of the current billing interval to a new lower stp count package

```php
$visa->websiteSubscription->downgrade([
    "intpWebsiteId" => {INTP_WEBSITE_ID},
    "packageId" => {PACKAGE_UUID}
])
```

#### Cancel - disable the subscription auto-renewal at the end of the current billing interval

```php
$visa->websiteSubscription->cancel([
    "intpWebsiteId" => {INTP_WEBSITE_ID},
])
```

#### Resume - re-enable the subscription auto-renewal at the end of the current billing interval

```php
$visa->websiteSubscription->resume([
    "intpWebsiteId" => {INTP_WEBSITE_ID},
])
```

#### Deactivate - immediately disables the subscription

```php
$visa->websiteSubscription->deactivate([
    "intpWebsiteId" => {INTP_WEBSITE_ID},
])
```

### API for managing a subscription of type `intpc`

#### Upgrade - immediately applies a higher stp count package to the subscription

```php
$visa->intpcSubscription->upgrade([
    "intpcId" => {INTP_WEBSITE_ID},
    "packageId" => {PACKAGE_UUID},
    "trial" => {true|false},
    "proRate" => {true|false}
])
```

#### Downgrade - auto-renew the subscription at the end of the current billing interval to a new lower stp count package

```php
$visa->intpcSubscription->downgrade([
    "intpcId" => {INTP_WEBSITE_ID},
    "packageId" => {PACKAGE_UUID}
])
```

#### Cancel - disable the subscription auto-renewal at the end of the current billing interval

```php
$visa->intpcSubscription->cancel([
    "intpcId" => {INTP_WEBSITE_ID},
])
```

#### Resume - re-enable the subscription auto-renewal at the end of the current billing interval

```php
$visa->intpcSubscription->resume([
    "intpcId" => {INTP_WEBSITE_ID},
])
```

#### Deactivate - immediately disables the subscription

```php
$visa->intpcSubscription->deactivate([
    "intpcId" => {INTP_WEBSITE_ID},
])
```

### Utils API

#### Generate a valid access token for the current INTP configuration.

```php
$visa->auth->generateINTPAccessToken();
```

#### Generate a valid access token for the current INTPc configuration.

```php
$visa->auth->generateINTPcAccessToken({INTP_CUSTOMER_ID});
```

## Dashboard IFrame

The IFrame is one of the main ways a user can interract with the data gathered for his website. The URL of the IFrame is [generated using the SDK](#generate-the-visitoranalytics-dashboard-iframe-url)

The resulting URL can be further enhanced with query parameters:

1. `allowUpgrade=true` - Show upgrade CTAs

Upgrade buttons will be added to the Dashboard for all features that require a certain minimum package.
Once the upgrade button is clicked, the iframe posts a message to the parent frame, containing the following payload:

```javascript
{
  "type": "UPGRADE_BUTTON_CLICKED",
  "data": {
    "intpWebsiteId": "", // string; external website id
    "intpCustomerId": "", // string; customer id
    "packageName": "", // string; current package name
    "packageId": "", // string; current package id
    "inTrial": true|false, // boolean;
    "expiresAt": "", // string; expiry date in ISO 8601 format
    "billingInterval": "monthly"|"yearly" // string;
  }
}
```

## Pagination

`list` methods support pagination options as follows:

```php
$visa->customers->list(['page' => 0, 'pageSize' => 5])
```

If no pagination options are provided, the `pageSize` defaults to 10 items.

The `page` count starts from 0.
