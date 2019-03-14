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
        preg_match("/([A-Za-z_ ]*)(.*),([A-Za-z_ ]*),([A-Za-z_ ]*)([0-9-]*)/", $addressString, $matches);

        list($original, $name, $street, $city, $state, $zipcode) = $matches;
        $address = new AddressStruct([
            'name'         => trim($name),
            'city'         => trim($city),
            'state'        => trim($state),
            'addressLine1' => trim($street),
            'zipcode'      => trim($zipcode),
        ]);
        $this->_checkAddress($address);

        return $address;
    }

    /**
     * 检查地址真实性
     * Check address authenticity
     * CarpCai <2018/12/2 7:52 PM>
     */
    private function _checkAddress(&$address)
    {
        //check state
        $statesMap = json_decode(file_get_contents(__DIR__ . '/../Json/US_states.json'), true);
        $state = $address->state;
        if(in_array($state, array_keys($statesMap))){
            $address->state_text = $statesMap[$state];
        }else if (in_array($state, array_values($statesMap))){
            $address->state = array_flip($statesMap)[$state];
            $address->state_text = $state;
        }else{
            $this->_setError($address, 'The state does not exist');
        }

        //check addressLine1
        list($HouseNumber) = explode(' ', $address->addressLine1);
        if(!is_numeric($HouseNumber)){
            $this->_setError($address, 'The address must start with a number');
        }

        //check zipcode
        if(!is_numeric($address->zipcode)){
            $this->_setError($address, 'the Zip code must be a number');
        }
    }
}