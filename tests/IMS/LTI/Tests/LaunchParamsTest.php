<?php 

namespace IMS\LTI\Tests;

use IMS\LTI\LaunchParams;
use IMS\LTI\Roles;

class LaunchParamsTest extends \PHPUnit_Framework_TestCase {
	
	public function testSetSomething_Ok() {
		$params = new LaunchParams();
		$params->set('context_id', 10);
		$params->set('context_label', 'Some context');
		
		$this->assertEquals('Some context', $params->get('context_label'));
		$this->assertEquals(10, $params->get('context_id'));
	}
	
	public function testGetUndefined_null() {
		$params = new LaunchParams();
		$this->assertNull($params->get('undefined'));
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testSetInvalidParamter_InvalidArgument() {
		$params = new LaunchParams();
		$params->set('unexsistent', 1);
	}
	
	public function testAddRole_Ok() {
		$params = new LaunchParams();
		$params->addRole(Roles::ALUMNI);
	}
	
	public function testSetRoles_Ok() {
		$params = new LaunchParams();
		$params->setRoles(array(Roles::ALUMNI, Roles::GUEST));
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testSetRoles_withInexistent() {
		$params = new LaunchParams();
		$params->setRoles(array(Roles::ALUMNI, 'unknown'));
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testAddRoleInexistent() {
		$params = new LaunchParams();
		$params->addRole('undefined');
	}
	
	public function testBuildParam_basic() {
		$params = new LaunchParams();
		$params->set('user_id', 11)->set('context_id', 22)->set('context_title', 'Some Course');
		$params->addRole(Roles::STUDENT)->addRole(Roles::OBSERVER);
		$built = $params->buildParams();
		
		// Build an array from the result and compare
		$result = array();
		foreach (explode('&', $built) as $chunk) {
			$param = explode("=", $chunk);
		
			if ($param) {
				$result[urldecode($param[0])] = urldecode($param[1]);
			}
		}
		
		$this->assertEquals(11, $result['user_id']);
		$this->assertEquals(22, $result['context_id']);
		$this->assertEquals('Some Course', $result['context_title']);
		$this->assertEquals(Roles::STUDENT.','.Roles::OBSERVER, $result['roles']);
	}
	
} 