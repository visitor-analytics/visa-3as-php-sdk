<!--- BEGIN HEADER -->
# Changelog

All notable changes to this project will be documented in this file.
<!--- END HEADER -->

## [3.0.3](https://github.com/visitor-analytics/visa-3as-php-sdk/compare/v3.0.2...v3.0.3) (2025-05-16)

### Bug Fixes


##### VISA-12767

* Refactor website & intpc subscription managers into own files ([f21ff0](https://github.com/visitor-analytics/visa-3as-php-sdk/commit/f21ff019027074d7466a9777cdb09da44a628553))


---

## [3.0.2](https://github.com/visitor-analytics/visa-3as-php-sdk/compare/v3.0.1...v3.0.2) (2025-05-16)

### Bug Fixes


##### VISA-12767

* Fix namespace for intpc hydrator ([cc6aa4](https://github.com/visitor-analytics/visa-3as-php-sdk/commit/cc6aa4a8a829197af4c1b5428ca8617f92ea8990))


---

## [3.0.1](https://github.com/visitor-analytics/visa-3as-php-sdk/compare/v3.0.0...v3.0.1) (2025-05-16)

### Bug Fixes


##### VISA-12767

* Fix namespace for intpcs ([84ca27](https://github.com/visitor-analytics/visa-3as-php-sdk/commit/84ca2761920f969c72981fd062bbf83602c243e7))


---

## [3.0.0](https://github.com/visitor-analytics/visa-3as-php-sdk/compare/v2.1.0...v3.0.0) (2025-05-16)

### Bug Fixes


##### VISA-12767

* Add support for v3 endpoints ([3f2b44](https://github.com/visitor-analytics/visa-3as-php-sdk/commit/3f2b448a05ff6e41752c274b7f0a5ace34c89d8a))
* Code review remarks ([4c4e52](https://github.com/visitor-analytics/visa-3as-php-sdk/commit/4c4e520dd27078722f8d8807ea023b4db977559f))
* Document subscription types ([dbcb68](https://github.com/visitor-analytics/visa-3as-php-sdk/commit/dbcb683f65764391b028872c50db200b0b3b0d45))


---

## [3.0.0](https://github.com/visitor-analytics/visa-3as-php-sdk/compare/v2.1.0...v3.0.0) (2025-05)

- Add support for website/intpc subscriptions
- Align internal nomenclature for 3AS:

### Migration guide

1. Replace `$visa->customers.*` => `$visa->intpcs->*`
2. Replace `$visa->customer(...)` => `$visa->intpc(...)`
3. Replace `$visa->subscriptions.*` => `$visa->websiteSubscription->*`
4. To maintain current website subscriptions (previously the single subscription type available) behaviour, refactor `$visa->websites->create` like this:
    - Old signature:
     ```php
     $visa->websites->create([
         'intpWebsiteId' => {INTP_WEBSITE_ID},
         'intpCustomerId' => {INTP_CUSTOMER_ID},
         'domain' => {INTP_WEBSITE_DOMAIN},
         'packageId' => {PACKAGE_UUID},
         'billingDate' => {ISO_DATE_STRING} (optional, defaults to current time)
     ]);
     ```
    - New signature:
     ```php
     $visa->websites->create([
         'website' => [
             'id' => {INTP_WEBSITE_ID|STRING},
             'domain' => {INTP_WEBSITE_DOMAIN},
             'package' => [
                 'id' => {UUID},
                 'billingDate' => {ISO_DATE_STRING} (optional, defaults to current time)
             ]
         ],
         'intpc' => [
             'id' => {INTP_CUSTOMER_ID|STRING}
         ],
     ]);
     ```

## [2.1.0](https://github.com/visitor-analytics/visa-3as-php-sdk/compare/v2.0.1...v2.1.0) (2025-04-22)

### Features

* Make packageId optional for website/intpc creation ([4655e1](https://github.com/visitor-analytics/visa-3as-php-sdk/commit/4655e19fc89d59a6d69f1c83633174285fe04147))

### Bug Fixes

* Remove version field from composer.json ([e152f9](https://github.com/visitor-analytics/visa-3as-php-sdk/commit/e152f952fb4c59dfbcd58dd28b072850bbd6dbeb))


---

## [2.0.1](https://github.com/visitor-analytics/visa-3as-php-sdk/compare/v1.3.6...v2.0.1) (2024-11-15)


---

## [2.0.0](https://github.com/visitor-analytics/visa-3as-php-sdk/compare/v1.3.5...v2.0.0) (2024-11-15)


---

## [1.4.3](https://github.com/visitor-analytics/visa-3as-php-sdk/compare/v1.3.5...v1.4.3) (2024-11-15)


---

## [1.4.2](https://github.com/visitor-analytics/visa-3as-php-sdk/compare/v1.3.5...v1.4.2) (2024-11-14)


---

## [1.4.1](https://github.com/visitor-analytics/visa-3as-php-sdk/compare/v1.3.5...v1.4.1) (2024-11-14)


---

## [1.4.0](https://github.com/visitor-analytics/visa-3as-php-sdk/compare/v1.3.4...v1.4.0) (2024-11-13)


---

## [1.3.4](https://github.com/visitor-analytics/visa-3as-php-sdk/compare/v1.3.3...v1.3.4) (2024-05-30)


---

## [1.3.3](https://github.com/visitor-analytics/visa-3as-php-sdk/compare/v1.3.2...v1.3.3) (2023-10-31)


---

## [1.3.2](https://github.com/visitor-analytics/visa-3as-php-sdk/compare/v1.3.1...v1.3.2) (2023-10-31)


---

## [1.3.1](https://github.com/visitor-analytics/visa-3as-php-sdk/compare/v1.3.0...v1.3.1) (2023-10-31)


---

## [1.3.0](https://github.com/visitor-analytics/visa-3as-php-sdk/compare/0.0.0...v0.1.0) (2023-05-26)


---

## [1.2.0](https://github.com/visitor-analytics/visa-3as-php-sdk/compare/0.0.0...v0.0.1) (2023-05-12)

---

## [1.1.2](https://github.com/visitor-analytics/visa-3as-php-sdk/compare/v0.0.1...v0.0.2) (2023-05-10)

---
