<?php

namespace IMS\LTI\Tests;

use IMS\LTI\ToolConsumer;
use IMS\LTI\ToolConfiguration;
use IMS\LTI\LaunchParameters;

class ToolConsumerTest extends \PHPUnit_Framework_TestCase {
	
	public function testDummy() {
		$config = new ToolConfiguration(array('launch_url'	=> 'http://www.google.com/'));
		$params = array(
			LaunchParameters::RESOURCE_LINK_ID	=> 1,
		);
		
		$consumer = new ToolConsumer('asd', 'def', $config, $params);
		$parameters = $consumer->generateLaunchData();
		//@TODO: Assert about response parameters
	}
	
}