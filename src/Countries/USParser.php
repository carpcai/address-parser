<?php
/**
 * Created by PhpStorm.
 * User: Carp Cai
 * Date: 2018/12/1
 * Time: 10:23 PM
 */

namespace CarpCai\AddressParser\Countries;

use CarpCai\AddressParser\AddressStruct;
use CarpCai\AddressParser\Data\UsaData;

class USParser extends BaseCountryParser implements iParser
{
    /**
     * CarpCai <2018/12/1 10:47 PM>
     * @param string $addressString
     * @return AddressStruct
     */
    public function split($addressString)
    {
        // Convert line breaks to commas
        $addressString = str_replace(["\r\n", "\n", "\r"], ", ", $addressString);

        $matches = [];

        // Example input: John Doe, 555 Test Drive, Testville, CA 98773
        preg_match(
            "/([A-Za-z_ ]*)(.*),([A-Za-z_ ]*),([A-Za-z_ ]*)([0-9]*)(-([0-9]{4})){0,1}/",
            $addressString,
            $matches
        );

        if (!$matches || count($matches) < 6) {
            $address = new AddressStruct([]);
            $address->error_code = -1;
            $address->error_message = 'Failed to match regular expression.';
            return $address;
        }

        list($original, $name, $street, $city, $state, $zipcode) = $matches;

        $street = ltrim($street, ", ");

        $address = new AddressStruct([
            'name'         => trim($name),
            'city'         => trim($city),
            'state'        => trim($state),
            'addressLine1' => trim($street),
            'zipcode'      => trim($zipcode),
        ]);
        
        if (isset($matches[7])) {
            $address->plus4 = $matches[7];
        }
        $this->_checkAddress($address);

        return $address;
    }

    /**
     * 检查地址真实性 (Check address authenticity)
     * CarpCai <2018/12/2 7:52 PM>
     *
     * @param AddressStruct $address
     * @return void
     */
    private function _checkAddress($address)
    {
        //check state
        $statesMap = UsaData::ALL_STATES;
        $state = $address->state;
        if (isset($statesMap[$state])) {
            // Check if we have a valid 2-char state code
            $address->state_text = $statesMap[$state];
        } elseif ($stateKey = array_search($state, $statesMap, true)) {
            // Try checking for the full state text
            $address->state = $stateKey;
            $address->state_text = $state;
        } else {
            $this->_setError($address, 'The state does not exist');
        }

        //check addressLine1
        list($HouseNumber) = explode(' ', $address->addressLine1);
        if (!is_numeric($HouseNumber)) {
            $this->_setError($address, 'The address must start with a number');
        }

        //check zipcode
        if (!is_numeric($address->zipcode)) {
            $this->_setError($address, 'the Zip code must be a number');
        }

        //check plus4
        if (!empty($address->plus4) && !is_numeric($address->plus4)) {
            $this->_setError($address, 'the plus4 code must be a number');
        }
    }
}
