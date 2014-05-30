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
		
		$this->parameters['lti_version'] = 
			array_key_exists('lti_version', $this->parameters) ? 
				$this->parameters['lti_version'] : 
				'LTI-1p0';
		$this->parameters['lti_message_type'] = 
			array_key_exists('lti_message_type', $this->parameters) ? 
				$this->parameters['lti_message_type'] : 
				'basic-lti-launch-request';

		$url = $this->toolConfiguration->getLaunchUrl();
		//@TODO: Remove query string parameters and append them to parameters
		
		$this->setOAuthParameters();
		
		$consumer = new \OAuth($this->consumerKey, $this->consumerSecret, OAUTH_SIG_METHOD_HMACSHA1, OAUTH_AUTH_TYPE_URI);
		$signature = $consumer->generateSignature('POST', $url, $this->parameters);
		$this->parameters[LaunchParameters::OAUTH_SIGNATURE] = $signature;
		
		return $this->parameters;
	}
	
	private function setOAuthParameters() {
		$this->parameters[LaunchParameters::OAUTH_CONSUMER_KEY] = $this->consumerKey;
		$this->parameters[LaunchParameters::OAUTH_SIGNATURE_METHOD] = 'HMAC-SHA1';
		$this->parameters[LaunchParameters::OAUTH_VERSION] = '1.0';
		$this->parameters[LaunchParameters::OAUTH_TIMESTAMP] = time();
		//@TODO: Nonce
	}
	
	private function hasRequiredParams() {
		return 	$this->consumerKey && 
				$this->consumerSecret && 
				$this->toolConfiguration->getLaunchUrl() && 
				array_key_exists(LaunchParameters::RESOURCE_LINK_ID, $this->parameters)
		;
	}
	
}