<?php
/**
 * User: Carp Cai
 * Date: 2018/11/30
 * Time: 6:39 PM
 */
namespace CarpCai\AddressParser\Tests;


use CarpCai\AddressParser\Parser;

class AddressParserTest
{
    /**
     * 测试是否能解析美国的地址
     * CarpCai <2018/12/1 12:40 PM>
     */
    public function testUSAddressParser()
    {
        $address = Parser::newParse('555 Test Drive, Testville, CA 98773');

        $this->assertEquals( 'US',  $address['country']);
        $this->assertEquals( 'CA',  $address['state']);
        $this->assertEquals( 'Testville',  $address['city']);
        $this->assertEquals( '555 Test Drive',  $address['addressLine1']);
    }
}