<?php

use \PHPUnit\Framework\TestCase;
use \Bahiazul\RedsysVirtualPos\Validation\Validator;

class ValidatorIntegerTest extends TestCase
{
    public function integerInputProvider()
    {
        return array(
            array(array('test' => ''),       true),
            array(array('test' => null),     true),

            array(array('test' => 15),       true),
            array(array('test' => -15),      true),
            array(array('test' => 15.5),     false),
            array(array('test' => 0x1A),     true),
            array(array('test' => 0123),     true),
            array(array('test' => 9e19),     false),
            array(array('test' => -9e19),    false),

            array(array('test' => "15"),     true),

            array(array('test' => "whatevs"), false),
        );
    }

    /**
     * @covers \Bahiazul\RedsysVirtualPos\Validation\Validator::integer
     * @dataProvider integerInputProvider
     */
    public function testInteger($inputs, $expected)
    {
        $rules  = array(
            'test' => array('integer')
        );

        $validation_result = Validator::validate($inputs, $rules);

        $this->assertEquals($expected, $validation_result->isSuccess());
    }
}
