<?php

namespace IMS\LTI;

class LaunchParams {

	/**
	 * List of the standard launch parameters for an LTI launch
	 */
	protected $stdParameters = array (
		'context_id',
		'context_label',
		'context_title',
		'context_type',
		'launch_presentation_css_url',
		'launch_presentation_document_target',
		'launch_presentation_height',
		'launch_presentation_locale',
		'launch_presentation_return_url',
		'launch_presentation_width',
		'lis_course_offering_sourcedid',
		'lis_course_section_sourcedid',
		'lis_outcome_service_url',
		'lis_person_contact_email_primary',
		'lis_person_name_family',
		'lis_person_name_full',
		'lis_person_name_given',
		'lis_person_sourcedid',
		'lis_result_sourcedid',
		'lti_message_type',
		'lti_version',
		'oauth_callback',
		'oauth_consumer_key',
		'oauth_nonce',
		'oauth_signature',
		'oauth_signature_method',
		'oauth_timestamp',
		'oauth_version',
		'resource_link_description',
		'resource_link_id',
		'resource_link_title',
		'roles',
		'tool_consumer_info_product_family_code',
		'tool_consumer_info_version',
		'tool_consumer_instance_contact_email',
		'tool_consumer_instance_description',
		'tool_consumer_instance_guid',
		'tool_consumer_instance_name',
		'tool_consumer_instance_url',
		'user_id',
		'user_image'
	);
	
	protected $parameters = array();
		
	//@TODO: Custom Parameters
	
	//@TODO: Extension Parameters
	
	protected $roles = array();
	
	public function buildParams() {
		$params = $this->parameters;
		if(count($this->roles) && !array_key_exists('roles', $params)) {
			$params['roles'] = join(',', $this->roles);
		}
		
		return http_build_query($params);
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
		if(!in_array($parameter, $this->stdParameters)) {
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