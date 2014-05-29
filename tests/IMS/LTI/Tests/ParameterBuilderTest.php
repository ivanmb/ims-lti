<?php 

namespace IMS\LTI\Tests;

use IMS\LTI\ParameterBuilder;
use IMS\LTI\Roles;

class ParameterBuilderTest extends \PHPUnit_Framework_TestCase {
	
	public function testSetSomething_Ok() {
		$params = new ParameterBuilder();
		$params->set('context_id', 10);
		$params->set('context_label', 'Some context');
		
		$this->assertEquals('Some context', $params->get('context_label'));
		$this->assertEquals(10, $params->get('context_id'));
	}
	
	public function testGetUndefined_null() {
		$params = new ParameterBuilder();
		$this->assertNull($params->get('undefined'));
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testSetInvalidParamter_InvalidArgument() {
		$params = new ParameterBuilder();
		$params->set('unexsistent', 1);
	}
	
	public function testAddRole_Ok() {
		$params = new ParameterBuilder();
		$params->addRole(Roles::ALUMNI);
	}
	
	public function testSetRoles_Ok() {
		$params = new ParameterBuilder();
		$params->setRoles(array(Roles::ALUMNI, Roles::GUEST));
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testSetRoles_withInexistent() {
		$params = new ParameterBuilder();
		$params->setRoles(array(Roles::ALUMNI, 'unknown'));
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testAddRoleInexistent() {
		$params = new ParameterBuilder();
		$params->addRole('undefined');
	}
	
	public function testBuildParam_basic() {
		$params = new ParameterBuilder();
		$params->set('user_id', 11)->set('context_id', 22)->set('context_title', 'Some Course');
		$params->addRole(Roles::STUDENT)->addRole(Roles::OBSERVER);
		$result = $params->buildParams();
		
		$this->assertEquals(11, $result['user_id']);
		$this->assertEquals(22, $result['context_id']);
		$this->assertEquals('Some Course', $result['context_title']);
		$this->assertEquals(Roles::STUDENT.','.Roles::OBSERVER, $result['roles']);
	}
	
} 