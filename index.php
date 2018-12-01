<?php
/**
 * Created by PhpStorm.
 * User: Carp Cai
 * Date: 2018/12/1
 * Time: 10:50 PM
 */

namespace CarpCai\AddressParser;


$parser = new \CarpCai\AddressParser\Parser('555 Test Drive, Testville, CA 98773');

//$parser = new CarpCai\AddressParser\AddressParser('555 Test Drive, Testville, CA 98773');
var_dump($parser);
var_dump($parser->state);