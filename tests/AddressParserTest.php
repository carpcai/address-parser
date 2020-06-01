<?php
/**
 * User: Carp Cai
 * Date: 2018/11/30
 * Time: 6:39 PM
 */
namespace CarpCai\AddressParser\Tests;

use CarpCai\AddressParser\Parser;
use PHPUnit\Framework\TestCase;

class AddressParserTest extends TestCase
{
    public function providerForUsAddressesAndExpectations()
    {
        return [
            [
                "Lee Harvey\n1582 Mountain Rd.\nTest River, NY 44349",
                ['1582 Mountain Rd.', 'Test River', 'NY', '44349', 'Lee Harvey', '', ''],
            ],
            ['555 Test Drive, Testville, CA 98773-1111', ['555 Test Drive', 'Testville', 'CA', '98773', '', '1111']],
            ['555 Test Drive, Testville, CA 98773', ['555 Test Drive', 'Testville', 'CA', '98773', '', '']],
            ['555 Test Drive, Testville, California 98773', ['555 Test Drive', 'Testville', 'CA', '98773', '', '']],
            ['555 Test Drive,Testville,CA 98773', ['555 Test Drive', 'Testville', 'CA', '98773', '', '']],
            ['555 Test Drive,Testville,CA98773', ['555 Test Drive', 'Testville', 'CA', '98773', '', '']],
            ['555 Test Drive,Testville,CA98773', ['555 Test Drive', 'Testville', 'CA', '98773', '', '']],
            ['555 Test Drive,Testville,CA', ['555 Test Drive', 'Testville', 'CA', '', '', '']],
            ['Carp Cai 555 Test Drive,Testville,CA', ['555 Test Drive', 'Testville', 'CA', '', 'Carp Cai', '', '']],
        ];
    }

    /**
     * 测试是否能解析美国的地址
     * CarpCai <2018/12/1 12:40 PM>
     * @dataProvider providerForUsAddressesAndExpectations
     *
     * @param string $inputString Input test string (comes via dataProvider)
     * @param array $expectedObjValues Expected parsed values (comes via dataProvider)
     */
    public function testRightUSAddressParse($inputString, array $expectedObjValues)
    {
        $expectedObjValues = [
            'addressLine1' => $expectedObjValues[0],
            'city' => $expectedObjValues[1],
            'state' => $expectedObjValues[2],
            'zipcode' => $expectedObjValues[3],
            'name' => $expectedObjValues[4],
            'plus4' => $expectedObjValues[5],
        ];

        $addressRes = Parser::newParse($inputString);

        $this->assertSame($expectedObjValues['addressLine1'], $addressRes->addressLine1);
        $this->assertSame($expectedObjValues['city'],  $addressRes->city);
        $this->assertSame($expectedObjValues['state'],  $addressRes->state);
        $this->assertSame($expectedObjValues['zipcode'],  $addressRes->zipcode);
        $this->assertSame($expectedObjValues['name'],  $addressRes->name);
        $this->assertSame($expectedObjValues['plus4'],  $addressRes->plus4);

    }

    public function providerForParseErrors()
    {
        return [
            ['Test Drive, Testville, CA 98773', -1, 'The address must start with a number'],
            ['I don\'t match anything', -1, 'Failed to match regular expression'],
            ['555 Test Drive, Testville, YX 98773-1111', -1, 'The state does not exist'],
        ];
    }

    /**
     * @dataProvider providerForParseErrors
     */
    public function testWrongUSAddressParse($inputString, $errorCode, $errorMessage)
    {
        $address = Parser::newParse($inputString);

        $this->assertSame($errorCode,  $address->error_code);
        $this->assertSame($errorMessage,  $address->error_message);
    }
}
