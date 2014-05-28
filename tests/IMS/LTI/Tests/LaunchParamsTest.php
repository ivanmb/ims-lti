<?php 

namespace IMS\LTI\Tests;

use IMS\LTI\LaunchParams;

class LaunchParamsTest extends \PHPUnit_Framework_TestCase {
	
	public function test_sayHello() {
		$this->assertEquals("Hello!", LaunchParams::sayHello());
	}
	
} 