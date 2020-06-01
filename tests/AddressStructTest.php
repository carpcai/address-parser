<?php

namespace CarpCai\AddressParser\Tests;

use CarpCai\AddressParser\AddressStruct;
use PHPUnit\Framework\TestCase;

class AddressStructTest extends TestCase
{
    public function testConstructorWithBadData()
    {
        $struct = new AddressStruct([]);
        $this->assertNull($struct->addressLine1);
    }
}
