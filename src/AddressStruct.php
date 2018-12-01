<?php
/**
 * Created by PhpStorm.
 * User: carpcai
 * Date: 2018/11/30
 * Time: 6:23 PM
 */

namespace CarpCai\AddressParser;

class AddressStruct
{
    const US = 'US';

    public $country;
    public $state;
    public $city;
    public $addressLine1;
    public $addressLine2;

    public function __construct($addressArray)
    {
        if (!$addressArray || !is_array($addressArray)) {
            return true;
        }
        $this->country      = isset($addressArray['country']) ? $addressArray['country'] : self::US;
        $this->state        = isset($addressArray['state']) ? $addressArray['state'] : '';
        $this->city         = isset($addressArray['city']) ? $addressArray['city'] : '';
        $this->addressLine1 = isset($addressArray['addressLine1']) ? $addressArray['addressLine1'] : '';
        $this->addressLine2 = isset($addressArray['addressLine2']) ? $addressArray['addressLine2'] : '';

        return $this;
    }

}