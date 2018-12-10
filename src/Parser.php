<?php
/**
 * Created by PhpStorm.
 * User: carpcai
 * Date: 2018/11/30
 * Time: 6:23 PM
 */

namespace CarpCai\AddressParser;

use CarpCai\AddressParser\Countries\USParser;

class Parser
{
    public $country;

    /**
     * CarpCai <2018/12/1 10:46 PM>
     * @param $addressString
     * @param string $country
     * @return AddressStruct
     */
    public function __construct($country = AddressStruct::US)
    {
        $this->setCountry($country);
    }

    public function setCountry($country)
    {
        if (in_array($country, [AddressStruct::US])) {
            $this->country = AddressStruct::US;
            return $this;
        }
        return $this;
    }

    /**
     *
     * CarpCai <2018/12/1 10:20 PM>
     */
    static function newParse($addressString, $country = AddressStruct::US)
    {
        $class = new static($addressString);
        $class->setCountry($country);
        return $class->_parse($addressString);
    }

    /**
     * CarpCai <2018/12/1 10:19 PM>
     */
    public function parse($addressString)
    {
        return $this->_parse($addressString);
    }

    /**
     * CarpCai <2018/12/1 10:46 PM>
     * @param $addressString
     * @param string $country
     * @return AddressStruct
     */
    private function _parse($addressString, $country = AddressStruct::US)
    {
        //TODO: 根据不同国家生成不同实例
        return (new USParser())->split($addressString);
    }
}
