<?php

namespace IMS\LTI;

use IMS\LTI\Exception\InvalidLTIConfigurationException;

class ToolConsumer {
	
	private $consumerKey;
	private $consumerSecret;
	/**
	 * @var ToolConfiguration
	 */
	private $toolConfiguration;
	private $parameters;
	
	private $timestamp;
	private $nonce;
	
	public function __construct($consumerKey, $consumerSecret, $toolConfiguration, $parameters) {
		$this->consumerKey = $consumerKey;
		$this->consumerSecret = $consumerSecret;
		$this->toolConfiguration = $toolConfiguration;
		$this->parameters = $parameters;	
	}
	
	public function generateLaunchData() {
		if(!$this->hasRequiredParams()) {
			throw new InvalidLTIConfigurationException("Some required parameters are missing");
		}
		
		$this->parameters['lti_version'] 		= $this->parameters['lti_version'] ? : 'LTI-1p0';
		$this->parameters['lti_message_type'] 	= $this->parameters['lti_version'] ? : 'basic-lti-launch-request';

		$uri = parse_url($this->toolConfiguration->getLaunchUrl());
		$host = $uri['host'];
		if($uri['port'] !== 80) {
			$uri = sprintf('%s:%s', $uri, $host);
		}
		
	}
	
	private function hasRequiredParams() {
		return 	$this->consumerKey && 
				$this->consumerSecret && 
				$this->toolConfiguration->getLaunchUrl() && 
				$this->parameters[LaunchParameters::RESOURCE_LINK_ID]
		;
	}
	
}