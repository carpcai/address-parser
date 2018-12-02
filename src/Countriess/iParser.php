<?php
/**
 * Created by PhpStorm.
 * User: Carp Cai
 * Date: 2018/12/1
 * Time: 10:25 PM
 */

namespace CarpCai\AddressParser\Countriess;


interface iParser
{

    public function split($address);
}