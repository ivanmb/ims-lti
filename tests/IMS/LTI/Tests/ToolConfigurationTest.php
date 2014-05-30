<?php 

namespace IMS\LTI\Tests;

use IMS\LTI\ToolConfiguration;
class ToolConfigurationTest extends \PHPUnit_Framework_TestCase {
	
	private $testXml = <<<XML
	<cartridge_basiclti_link xsi:schemaLocation="http://www.imsglobal.org/xsd/imslticc_v1p0 http://www.imsglobal.org/xsd/lti/ltiv1p0/imslticc_v1p0.xsd http://www.imsglobal.org/xsd/imsbasiclti_v1p0 http://www.imsglobal.org/xsd/lti/ltiv1p0/imsbasiclti_v1p0p1.xsd http://www.imsglobal.org/xsd/imslticm_v1p0 http://www.imsglobal.org/xsd/lti/ltiv1p0/imslticm_v1p0.xsd http://www.imsglobal.org/xsd/imslticp_v1p0 http://www.imsglobal.org/xsd/lti/ltiv1p0/imslticp_v1p0.xsd" xmlns:lticm="http://www.imsglobal.org/xsd/imslticm_v1p0" xmlns:blti="http://www.imsglobal.org/xsd/imsbasiclti_v1p0" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:lticp="http://www.imsglobal.org/xsd/imslticp_v1p0" xmlns="http://www.imsglobal.org/xsd/imslticc_v1p0">
	  <blti:title>Test Config</blti:title>
	  <blti:description>Description of boringness</blti:description>
	  <blti:launch_url>http://www.example.com/lti</blti:launch_url>
	  <blti:secure_launch_url>https://www.example.com/lti</blti:secure_launch_url>
	  <blti:vendor>
	    <lticp:name>test.tool</lticp:name>
	    <lticp:code>test</lticp:code>
	    <lticp:description>We test things</lticp:description>
	    <lticp:url>http://www.example.com/about</lticp:url>
	    <lticp:contact>
	      <lticp:name>Joe Support</lticp:name>
	      <lticp:email>support@example.com</lticp:email>
	    </lticp:contact>
	  </blti:vendor>
	  <blti:custom>
	    <lticm:property name="custom1">customval1</lticm:property>
	    <lticm:property name="custom2">customval2</lticm:property>
	  </blti:custom>
	  <blti:extensions platform="example.com">
	    <lticm:property name="extkey1">extval1</lticm:property>
	    <lticm:property name="extkey2">extval2</lticm:property>
	    <lticm:options name="extopt1">
	      <lticm:property name="optkey1">optval1</lticm:property>
	      <lticm:property name="optkey2">optval2</lticm:property>
	    </lticm:options>
	  </blti:extensions>
	  <blti:extensions platform="two.example.com">
	    <lticm:property name="ext1key">ext1val</lticm:property>
	  </blti:extensions>
	  <cartridge_bundle identifierref="BLTI001_Bundle"/>
	</cartridge_basiclti_link>
XML;
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testConstructWithInvalid() {
		new ToolConfiguration(array('title'	=> 'some title', 'unknown' => 'unknown'));
	}
	
	public function testConstructOk() {
		new ToolConfiguration(array('title'	=> 'some title', 'icon' => 'someurl'));
	}
	
	public function testFromXml() {
		$config = ToolConfiguration::createFromXml($this->testXml);
		$this->assertEquals('Test Config', $config->getTitle());
		$this->assertEquals('Description of boringness', $config->getDescription());
		$this->assertEquals('http://www.example.com/lti', $config->getLaunchUrl());
		//@TODO: test the rest
	}
} 