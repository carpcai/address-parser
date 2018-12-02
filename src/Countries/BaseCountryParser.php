<?php
/**
 * Created by PhpStorm.
 * User: Carp Cai
 * Date: 2018/12/1
 * Time: 10:23 PM
 */

namespace CarpCai\AddressParser\Countries;

class BaseCountryParser
{
    /**
     * CarpCai <2018/12/2 7:57 PM>
     */
    protected function _setError(&$addressStruct, $error_message)
    {
        $addressStruct->error_code = -1;
        $addressStruct->error_message = $error_message;
    }
}