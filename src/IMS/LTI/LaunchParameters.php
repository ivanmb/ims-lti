<?php

namespace IMS\LTI;

abstract class LaunchParameters extends EnumParam {
	
	const CONTEXT_ID = 'context_id';
	const CONTEXT_LABEL = 'context_label';
	const CONTEXT_TITLE = 'context_title';
	const CONTEXT_TYPE = 'context_type';
	const LAUNCH_PRESENTATION_CSS_URL = 'launch_presentation_css_url';
	const LAUNCH_PRESENTATION_DOCUMENT_TARGET = 'launch_presentation_document_target';
	const LAUNCH_PRESENTATION_HEIGHT = 'launch_presentation_height';
	const LAUNCH_PRESENTATION_LOCALE = 'launch_presentation_locale';
	const LAUNCH_PRESENTATION_RETURN_URL = 'launch_presentation_return_url';
	const LAUNCH_PRESENTATION_WIDTH = 'launch_presentation_width';
	const LIS_COURSE_OFFERING_SOURCEDID = 'lis_course_offering_sourcedid';
	const LIS_COURSE_SECTION_SOURCEDID = 'lis_course_section_sourcedid';
	const LIS_OUTCOME_SERVICE_URL = 'lis_outcome_service_url';
	const LIS_PERSON_CONTACT_EMAIL_PRIMARY = 'lis_person_contact_email_primary';
	const LIS_PERSON_NAME_FAMILY = 'lis_person_name_family';
	const LIS_PERSON_NAME_FULL = 'lis_person_name_full';
	const LIS_PERSON_NAME_GIVEN = 'lis_person_name_given';
	const LIS_PERSON_SOURCEDID = 'lis_person_sourcedid';
	const LIS_RESULT_SOURCEDID = 'lis_result_sourcedid';
	const LTI_MESSAGE_TYPE = 'lti_message_type';
	const LTI_VERSION = 'lti_version';
	const OAUTH_CALLBACK = 'oauth_callback';
	const OAUTH_CONSUMER_KEY = 'oauth_consumer_key';
	const OAUTH_NONCE = 'oauth_nonce';
	const OAUTH_SIGNATURE = 'oauth_signature';
	const OAUTH_SIGNATURE_METHOD = 'oauth_signature_method';
	const OAUTH_TIMESTAMP = 'oauth_timestamp';
	const OAUTH_VERSION = 'oauth_version';
	const RESOURCE_LINK_DESCRIPTION = 'resource_link_description';
	const RESOURCE_LINK_ID = 'resource_link_id';
	const RESOURCE_LINK_TITLE = 'resource_link_title';
	const ROLES = 'roles';
	const TOOL_CONSUMER_INFO_PRODUCT_FAMILY_CODE = 'tool_consumer_info_product_family_code';
	const TOOL_CONSUMER_INFO_VERSION = 'tool_consumer_info_version';
	const TOOL_CONSUMER_INSTANCE_CONTACT_EMAIL = 'tool_consumer_instance_contact_email';
	const TOOL_CONSUMER_INSTANCE_DESCRIPTION = 'tool_consumer_instance_description';
	const TOOL_CONSUMER_INSTANCE_GUID = 'tool_consumer_instance_guid';
	const TOOL_CONSUMER_INSTANCE_NAME = 'tool_consumer_instance_name';
	const TOOL_CONSUMER_INSTANCE_URL = 'tool_consumer_instance_url';
	const USER_ID = 'user_id';
	const USER_IMAGE = 'user_image';
	
}