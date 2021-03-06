<?php

use \PHPUnit\Framework\TestCase;
use \Bahiazul\RedsysVirtualPos\Validation\Validator;

class ValidatorMaxLengthTest extends TestCase
{
    public function maxLengthInputProvider()
    {
        return array(
            array(array('test' => null),          array('test' => array('max_length(5)')),  true),
            array(array('test' => ''),            array('test' => array('max_length(5)')),  true),

            array(array('test' => 'ABCDE'),       array('test' => array('max_length(5)')),  true),
            array(array('test' => 'ABCDE'),       array('test' => array('max_length(10)')), true),
            array(array('test' => 'ABCDE'),       array('test' => array('max_length(3)')),  false),

            array(array('test' => 'ABCDE123'),    array('test' => array('max_length(8)')),  true),
            array(array('test' => 'ABCDE123'),    array('test' => array('max_length(12)')), true),
            array(array('test' => 'ABCDE123'),    array('test' => array('max_length(5)')),  false),

            array(array('test' => 'ABCDE123?!@'), array('test' => array('max_length(11)')), true),
            array(array('test' => 'ABCDE123?!@'), array('test' => array('max_length(15)')), true),
            array(array('test' => 'ABCDE123?!@'), array('test' => array('max_length(5)')),  false),

            array(array('test' => '   ABCDE   '), array('test' => array('max_length(11)')), true),
            array(array('test' => '   ABCDE   '), array('test' => array('max_length(15)')), true),
            array(array('test' => '   ABCDE   '), array('test' => array('max_length(5)')),  false),
        );
    }

    /**
     * @covers \Bahiazul\RedsysVirtualPos\Validation\Validator::max_length
     * @dataProvider maxLengthInputProvider
     */
    public function testMaxLength($inputs, $rules, $expected)
    {
        $validation_result = Validator::validate($inputs, $rules);

        $this->assertEquals($expected, $validation_result->isSuccess());
    }
}
