# Celmedia (LoyalQuo) SMS SDK for PHP

This repository has the open source PHP SDK that allows you to send SMS from your PHP app.

## Installation

This SDK can be installed via composer.

```bash
$ composer require lapix/celmedia-sms
```

## Special Characters

The following special characters are removed or replaced:

'á', 'Á', 'é', 'É', 'í', 'Í', 'ó', 'Ó', 'ú', 'Ú', '^', '`', '¬', '‘', '“', '\*', '\#', 'ª', 'º', '>', '<', 'ü', '\[', '\]', '¿', '¡', 'ñ', 'Ñ', '{', '}', '\\', '/', '|', '&', '\~', ';', '½', '¼', '¾' 

And those are the respective replacement values:

'a', 'A', 'e', 'E', 'i', 'I', 'o', 'O', 'u', 'U', '', '', '', '', '', '', '', 'a', 'o', '', '', 'u', '(', ')', '', '', 'n', 'N', '(', ')', '', '', '', 'Y', '-', ',', '1/2', '1/4', '3/4'

## Usage

```php
<?php

use Lapix\Celmedia\Sms\Client;
use Lapix\Celmedia\Sms\SmsSender;
use Lapix\Celmedia\Sms\SmsFactory;
use Lapix\Celmedia\Sms\JsonEncoder;
use Lapix\Celmedia\Sms\SmsSanitizer;
use Lapix\Celmedia\Sms\CelmediaSmsException;

$sanitizer = new SmsSanitizer();
$createSms = new SmsFactory($sanitizer);

$sender = new SmsSender(
    new Client(
        new \GuzzleHttp\Client(),
        'username',
        'password',
        'apiKey'
    ),
    new JsonEncoder()
);

try {
    // Send multiple sms.'Test méssage' is sent as 'Test message'
    $sender->send([$createSms->createSms('Test méssage', '3111111111', '123456')]);
    // or a single
    $sender->sendSingle($createSms->createSms('Test message', '3111111111', ''));
} catch (CelmediaSmsException $exception) {
    // Internal server error
}
```

## Test

Composer is a prerequisite. Run the unit test with the following command

```bash
$ php ./vendor/bin/phpunit
```

Run the integration test like this

```bash
$ INTEGRATION_TEST=true CELMEDIA_USER= CELMEDIA_PASSWORD= CELMEDIA_API_KEY= CELMEDIA_TEST_PHONE= php ./vendor/bin/phpunit
```

## TODO
- [ ] Improve the documentation
- [ ] Add test cases
- [ ] Handle the response exceptions

