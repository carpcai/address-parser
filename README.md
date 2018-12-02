# Address Parser

[![Build Status](https://www.travis-ci.org/carpcai/address-parser.svg?branch=master)](https://www.travis-ci.org/carpcai/address-parser)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/carpcai/address-parser/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/carpcai/address-parser/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/carpcai/address-parser/badges/build.png?b=master)](https://scrutinizer-ci.com/g/carpcai/address-parser/build-status/master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/carpcai/address-parser/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)

A PHP library covers PHP 5.4 to 7.3, split an address street to street, states, city, zipcode.


## Installation
This project can be installed via Composer:
```shell
$ composer require carpcai/address-parser
```

## How to use
You can use the service as follows:

```
$addressObj = Parser::newParse('555 Test Drive, Testville, CA 98773');

var_dump([
    'country'      => $addressObj->country,
    'state'        => $addressObj->state,
    'city'         => $addressObj->city,
    'addressLine1' => $addressObj->addressLine1,
    'addressLine2' => $addressObj->addressLine2,
    'zipcode'      => $addressObj->zipcode,
]);
```

The output of this command will be:
```
array(6) {
  ["country"]=>
  string(2) "US"
  ["state"]=>
  string(2) "CA"
  ["city"]=>
  string(9) "Testville"
  ["addressLine1"]=>
  string(14) "555 Test Drive"
  ["addressLine2"]=>
  string(0) ""
  ["zipcode"]=>
  string(5) "98773"
}
```


