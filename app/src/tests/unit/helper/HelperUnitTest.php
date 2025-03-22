<?php

namespace src\tests\unit\helper;

use PHPUnit\Framework\TestCase;
use src\helper\Helper;
use stdClass;

class HelperUnitTest extends TestCase
{
    public function testObjectToArray() {

        $array = [
            "atr1" => "val1",
            "atr2" => "val2",
            "atr3" => "val3",
        ];
        $object = new stdClass();
        $object->atr1 = "val1";
        $object->atr2 = "val2";
        $object->atr3 = "val3";

        $this->assertNotSame($array, $object);
        $this->assertSame(Helper::objectToArray($array), $array);
        $this->assertSame(Helper::objectToArray($object), $array);
    }

    public function testValidateEmail() {

        $valid = "teste@teste.com";
        $invalid1 = "";
        $invalid2 = "teste";

        $this->assertTrue(Helper::validateEmail($valid));
        $this->assertFalse(Helper::validateEmail($invalid1));
        $this->assertFalse(Helper::validateEmail($invalid2));
    }

    public function testValidateCPF() {

        $valid = "386.802.530-81";
        $invalid1 = "111.111.111-11";
        $invalid2 = "123.456.789-12";

        $this->assertTrue(Helper::validateCPF($valid));
        $this->assertFalse(Helper::validateCPF($invalid1));
        $this->assertFalse(Helper::validateCPF($invalid2));
    }

    public function testValidateCNPJ() {

        $valid = "46.457.322/0001-65";
        $invalid1 = "11.111.111/1111-11";
        $invalid2 = "12.345.678/9123-45";

        $this->assertTrue(Helper::validateCNPJ($valid));
        $this->assertFalse(Helper::validateCNPJ($invalid1));
        $this->assertFalse(Helper::validateCNPJ($invalid2));
    }
}
