<?php
/**
 * Created by PhpStorm.
 * User: carpcai
 * Date: 2018/11/30
 * Time: 6:23 PM
 */

namespace CarpCai\AddressParser;

use CarpCai\AddressParser\Data\UsaData;

class AddressStruct
{
    const US = UsaData::COUNTRY_CODE;

    /** @var int Error code, will be set if an error happened during parsing. */
    public $error_code;

    /** @var string Error message, will be set if an error happened during parsing. */
    public $error_message;

    /** @var string 2-char country code (abbreviation). E.g.: US */
    public $country;

    /** @var string 2-char state code (abbreviation). E.g.: NY */
    public $state;

    /** @var string Full name of the state, no abbreviation. E.g.: New York */
    public $state_text;
    public $city;
    public $addressLine1;
    public $addressLine2;
    public $name;
    public $zipcode;
    public $plus4;

    public function __construct($addressArray)
    {
        if (!$addressArray || !is_array($addressArray)) {
            return;
        }
        $this->country      = isset($addressArray['country']) ? $addressArray['country'] : UsaData::COUNTRY_CODE;
        $this->state        = isset($addressArray['state']) ? $addressArray['state'] : '';
        $this->city         = isset($addressArray['city']) ? $addressArray['city'] : '';
        $this->addressLine1 = isset($addressArray['addressLine1']) ? $addressArray['addressLine1'] : '';
        $this->addressLine2 = isset($addressArray['addressLine2']) ? $addressArray['addressLine2'] : '';
        $this->zipcode      = isset($addressArray['zipcode']) ? $addressArray['zipcode'] : '';
        $this->name         = isset($addressArray['name']) ? $addressArray['name'] : '';
        $this->plus4        = isset($addressArray['plus4']) ? $addressArray['plus4'] : '';
    }
}
