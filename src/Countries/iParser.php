<?php
/**
 * Created by PhpStorm.
 * User: Carp Cai
 * Date: 2018/12/1
 * Time: 10:25 PM
 */

namespace CarpCai\AddressParser\Countries;

use CarpCai\AddressParser\AddressStruct;

interface iParser
{
    /**
     * @param string $address Input address string to be parsed
     *
     * @return AddressStruct Returns an AddressStruct; if a parse error occurred, the AddressStruct will have an
     *                       error_code and error_message set on it.
     */
    public function split($address);
}
