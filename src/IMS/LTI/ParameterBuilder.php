<?php

namespace IMS\LTI;

class ParameterBuilder {
	
	protected $parameters = array();
		
	//@TODO: Custom Parameters
	
	//@TODO: Extension Parameters
	
	protected $roles = array();
	
	public function buildParams() {
		$params = $this->parameters;
		if(count($this->roles) && !array_key_exists('roles', $params)) {
			$params['roles'] = join(',', $this->roles);
		}
		
		return $params;
	}
	
	/**
	 * Set the roles for the current launch
	 * Full list of roles can be found here: 
	 * http://www.imsglobal.org/LTI/v1p1pd/ltiIMGv1p1pd.html#_Toc309649700
	 * 
	 * @param array $roles
	 */
	public function setRoles(array $roles) {
		array_walk($roles, function($role) {
			if(!Roles::isValid($role)) {
				throw new \InvalidArgumentException("The role $role is invalid. Please refer to Roles class or documentation");
			}
		});
		
		$this->roles = $roles;
		
		return $this;
	}
	
	public function addRole($role) {
		if(!Roles::isValid($role)) {
			throw new \InvalidArgumentException("The role $role is invalid. Please refer to Roles class or documentation");
		}
		
		$this->roles[] = $role;
		
		return $this;
	}

	public function set($parameter, $value) {
		if(!LaunchParameters::isValid($parameter)) {
			throw new \InvalidArgumentException("The parameter $parameter was not recognized as a standard parameter");
		}
		$this->parameters[$parameter] = $value;
		
		return $this;
	}
	
	public function get($parameter) {
		if (array_key_exists($parameter, $this->parameters))
			return $this->parameters[$parameter];
	}
	
} 