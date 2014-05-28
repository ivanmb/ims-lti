<?php

namespace IMS\LTI;

class LaunchParams {

	protected $settings = array ();

	public function __call($methodName, $params = null) {
		$methodPrefix = substr($methodName, 0, 3);
		$key = strtolower(substr($methodName, 3));
		
		if ($methodPrefix == 'set' && count($params) == 1) {
			$value = $params [0];
			$this->settings [$key] = $value;
			
		} elseif ($methodPrefix == 'get') {
			if (array_key_exists($key, $this->settings))
				return $this->settings[$key];
			
		} else {
			throw new \InvalidArgumentException("The method $methodName was not found");
		}
	
	}
} 