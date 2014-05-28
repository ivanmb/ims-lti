<?php 

namespace IMS\LTI\Tests;

use IMS\LTI\LaunchParams;

class LaunchParamsTest extends \PHPUnit_Framework_TestCase {
	
	public function testSetSomething_Ok() {
		$params = new LaunchParams();
		$params->setSomething("Hello!");
		$params->setOther(10);
		
		$this->assertEquals("Hello!", $params->getSomething());
		$this->assertEquals(10, $params->getOther());
	}
	
	public function testGetUndefined_null() {
		$params = new LaunchParams();
		$this->assertNull($params->getSomething());
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testUnknownMethod_InvalidArgument() {
		$params = new LaunchParams();
		$params->unexistent();
	}
	
} 