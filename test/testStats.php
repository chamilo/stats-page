<?php
/**
 * Created by JetBrains PhpStorm.
 * User: albert1t0
 * Date: 24/08/12
 * Time: 08:47 AM
 * To change this template use File | Settings | File Templates.
 */

include('../main.php');

class testStats extends PHPUnit_Framework_TestCase
{
    public function testConection() {
        $data = retrivedata();
        $this->assertNotEmpty($data);
    }

    public function testData() {
        $tamano = sizeof(retrivedata());
        $this->assertEquals($tamano,7);
    }

    public function testChart() {
        $this->assertNotEmpty(chart(0, 'values'));
        $this->assertNotEmpty(chart(0, 'ticks'));
        $this->assertNotEmpty(chart(0, 'pie'));
        $this->assertNotEmpty(chart(1, 'values'));
        $this->assertNotEmpty(chart(1, 'ticks'));
        $this->assertNotEmpty(chart(1, 'pie'));
        $this->assertNotEmpty(chart(2, 'values'));
        $this->assertNotEmpty(chart(2, 'ticks'));
        $this->assertNotEmpty(chart(2, 'pie'));
        $this->assertNotEmpty(chart(4, 'values'));
        $this->assertNotEmpty(chart(4, 'ticks'));
        $this->assertNotEmpty(chart(5, 'values'));
        $this->assertNotEmpty(chart(5, 'ticks'));
        $this->assertNotEmpty(chart(6, 'values'));
        $this->assertNotEmpty(chart(6, 'ticks'));

    }
}