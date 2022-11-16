# VisitorAnalytics PHP SDK

A simple API wrapper for integrating the AAAS APIs provided by VisitorAnalytics

## Installation

### Composer

#### composer.json

```json
{
  "repositories": [
    {
      "type": "github",
      "url": "https://github.com/visitor-analytics/visa-3as-php-sdk"
    }
  ]
}
```

#### Install via Composer

```
composer require visa/3as-sdk -W
```

### Git

```
git clone https://github.com/visitor-analytics/visa-3as-php-sdk.git
```

## Getting Started

```php
$visa = new VisitorAnalytics([
     'intp' => [
         'id' => {INTP_ID},
         'privateKey' => {INTP_RS256_PRIVATE_KEY}
     ],
     'env' => 'dev'
]);
```

<br>

## Pagination

`list` methods support pagination options as follows:

```php
$visa->customers->list(['page' => 0, 'pageSize' => 5])
```

If no pagination options are provided, the `pageSize` defaults to 10 items.

The `page` count starts from 0.
<br>

## Available APIs

- customer
- customers
- package
- packages
- website
- websites
- auth

## Customers API

Integration partners (INTP) are able to get data about their customers (INTPc).

### List all available customers

```php
$visa->customers->list();
```

### Get a single customer by its INTP given id

```php
$visa->customers->getByIntpCustomerId({INTP_CUSTOMER_ID});
```

### Register a new customer

```php
$visa->customers->create([
        'intpCustomerId' => {INTP_CUSTOMER_ID},
        'email' => {INTP_CUSTOMER_EMAIL},
        'website' => [
            'intpWebsiteId' => {INTP_WEBSITE_ID},
            'domain' => {INTP_WEBSITE_DOMAIN_URI},
            'packageId' => {PACKAGE_UUID}
        ]
]);
```

<br>

## Customer API

### List all websites belonging to an INTP Customer

```php
$visa->customer({INTP_CUSTOMER_ID})->listWebsites();
```

### Delete a Customer belonging to an INTP

```php
$visa->customer({INTP_CUSTOMER_ID})->delete();
```

### Generate the VisitorAnalytics Dashboard IFrame Url

```php
$visa->customer({INTP_CUSTOMER_ID})->generateIFrameDashboardUrl({INTP_WEBSITE_ID});
```

<br>

## Packages API

An Integration Partner (INTP) is able to get data about their packages

### List all available packages

```php
$visa->packages->list();
```

### Get a single package by ID

```php
$visa->packages->getById({PACKAGE_UUID});
```

### Create a package

```php
$visa->packages->create([
    'name' => {PACKAGE_NAME},
    'touchpoints' => {TOUCHPOINT_LIMIT},
    'price' => {FLOAT},
    'currency' => {CURRENCY_CODE}, // ex: EUR, USD, RON
    'period' => {PERIOD}, // ex: monthly, yearly
]);
```

<br>

## Package API

### An INTP can update its packages

```php
$visa->package({PACKAGE_UUID})->update([
    'name' => {UPDATED_PACKAGE_NAME}
]);
```

<br>

## Websites API

### List all websites

```php
$visa->websites->list();
```

### Get a single website by its INTP given id

```php
$visa->websites->getByIntpWebsiteId({INTP_WEBSITE_ID});
```

### Create a website

```php
$visa->websites->create([
    'intpWebsiteId' => {INTP_WEBSITE_ID},
    'intpCustomerId' => {INTP_CUSTOMER_ID},
    'domain' => {INTP_WEBSITE_DOMAIN},
    'packageId' => {PACKAGE_UUID}
]);
```

<br>

## Website API

### Delete a website by its INTP given id

```php
$visa->website({INTP_WEBSITE_ID})->delete());
```

<br>

## Subscription Notifications

### API for managing subscription state

#### Upgrade - immediately applies a higher stp count package to the subscription

```php
$visa->subscriptions->upgrade([
    "websiteId" => {INTP_WEBSITE_ID},
    "packageId" => {PACKAGE_UUID}
])
```

#### Downgrade - auto-renew the subscription at the end of the current billing interval to a new lower stp count package

```php
$visa->subscriptions->downgrade([
    "websiteId" => {INTP_WEBSITE_ID},
    "packageId" => {PACKAGE_UUID}
])
```

#### Cancel - disable the subscription auto-renewal at the end of the current billing interval

```php
$visa->subscriptions->cancel([
    "websiteId" => {INTP_WEBSITE_ID},
])
```

#### Resume - re-enable the subscription auto-renewal at the end of the current billing interval

```php
$visa->subscriptions->resume([
    "websiteId" => {INTP_WEBSITE_ID},
])
```

#### Deactivate - immediately disables the subscription, reversible by an upgrade

```php
$visa->subscriptions->deactivate([
    "websiteId" => {INTP_WEBSITE_ID},
])
```

## Utils API

### Generate a valid access token for the current INTP configuration.

```php
$visa->auth->generateINTPAccessToken();
```

### Generate a valid access token for the current INTPc configuration.

```php
$visa->auth->generateINTPcAccessToken({INTP_CUSTOMER_ID});
```
