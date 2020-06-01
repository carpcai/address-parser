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
     * @param string $country Country to load assumptions for. Currently, only US is supported.
     */
    public function __construct($country = AddressStruct::US)
    {
        $this->setCountry($country);
    }

    /**
     * @param string $country Two letter country code.
     *
     * @return $this
     */
    public function setCountry($country)
    {
        if (in_array($country, [AddressStruct::US], true)) {
            $this->country = AddressStruct::US;
        }
        return $this;
    }

    /**
     * CarpCai <2018/12/1 10:20 PM>
     *
     * @param string $addressString
     * @param string $country Two letter country code.
     *
     * @return AddressStruct
     */
    public static function newParse($addressString, $country = AddressStruct::US)
    {
        $class = new static($addressString);
        $class->setCountry($country);
        return $class->parse($addressString);
    }

    /**
     * CarpCai <2018/12/1 10:19 PM>
     *
     * @param string $addressString
     *
     * @return AddressStruct
     */
    public function parse($addressString)
    {
        //TODO: 根据不同国家生成不同实例 (Generate different examples according to different countries)
        return (new USParser())->split($addressString);
    }
}
