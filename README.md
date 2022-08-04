# VisitorAnalytics PHP SDK

A simple API wrapper for integrating the AAAS APIs provided by VisitorAnalytics

## Installation

### Composer
```
composer require visa/3as-api-sdk
```

### Git

```
git clone https://github.com/visa/3as-api-sdk.git
```

## Getting Started

```php
$visa = new VisitorAnalytics([
     'intp' => [
         'id' => {INTP_ID},
         'domain' => {INTP_DOMAIN},
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

* customer
* customers
* package
* packages
* website
* websites
* notifications
* utils

## Customers API

Integration partners (INTP) are able to get data about their customers (INTPc).

### List all available customers

```php
$visa->customers->list();
```

### Get a single customer by its externalId

```php
$visa->customers->getByExternalId({INTP_CUSTOMER_ID});
```

### Register a new customer

```php
$visa->customers->create([
        'externalId' => {INTP_CUSTOMER_ID},
        'email' => {INTP_CUSTOMER_EMAIL},
        'website' => [
            'externalId' => {INTP_WEBSITE_ID},
            'domain' => {INTP_WEBSITE_DOMAIN_URI},
            'packageId' => {PACKAGE_UUID}
        ]
]);
```
<br>

## Customer API

### List all websites belonging to a INTP Customer

```php
$visa->customer({INTP_CUSTOMER_ID})->listWebsites();
```

### Delete a website belonging to a INTP Customer

```php
$visa->customer({INTP_CUSTOMER_ID})->delete();
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
    'touchpoints' => {TOUCHPOINT_LIMIT}
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

An Integration Partner (INTP) is able to get data about their websites.

### List all websites

```php
$visa->websites->list();
```

### Get a single website by its external ID

```php
$visa->websites->getByExternalId({INTP_WEBSITE_ID});
```

### Create a website

```php 
$visa->websites->create([
    'externalId' => {INTP_WEBSITE_ID},
    'externalCustomerId' => {INTP_CUSTOMER_ID},
    'domain' => {INTP_WEBSITE_DOMAIN},
    'packageId' => {PACKAGE_UUID}
]);
```
<br>

## Website API

### Delete a website of a INTP customer by its external ID

```php
$visa->website({INTP_WEBSITE_ID})->delete());
```
<br>

## Utils API

### Generate a valid access token for the current INTP configuration.

```php
$visa->utils->auth->generateINTPAccessToken();
```

### Generate a valid access token for the current INTPc configuration.

```php
$visa->utils->auth->generateINTPcAccessToken();
```

### Generate a valid uri for setting up the VisitorAnalytics Dashboard IFrame

```php
$visa->utils->iframe->generateDashboardUri();
```