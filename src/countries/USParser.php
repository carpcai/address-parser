<?php
/**
 * Created by PhpStorm.
 * User: Carp Cai
 * Date: 2018/12/1
 * Time: 10:23 PM
 */

namespace CarpCai\AddressParser\Countries;

use CarpCai\AddressParser\AddressStruct;

class USParser extends BaseCountryParser implements iParser
{
    /**
     * CarpCai <2018/12/1 10:47 PM>
     * @param $addressString
     * @return AddressStruct
     */
    public function split($addressString)
    {
        $addressString = "555 Test Drive, Testville, CA 98773";

        preg_match("/(.+), (\w+), (\w+) (\w+)/", $addressString, $matches);

        list($original, $street, $city, $state, $zip) = $matches;

        return (new AddressStruct([
            'addressLine1' => $street,
            'city'         => $city,
            'state'        => $state,
            'zipcode'      => $zip,
        ]));
    }
}