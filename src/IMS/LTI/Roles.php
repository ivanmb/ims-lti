<?php

namespace IMS\LTI;

abstract class Roles {
	const STUDENT 				= 'student';
	const FACULTY 				= 'faculty';
	const MEMBER 				= 'member';
	const LEARNER 				= 'learner';
	const INSTRUCTOR 			= 'instructor';
	const MENTOR 				= 'mentor';
	const STAFF 				= 'staff';
	const ALUMNI 				= 'alumni';
	const PROSPECTIVE_STUDENT 	= 'prospectivestudent';
	const GUEST 				= 'guest';
	const OTHER 				= 'other';
	const ADMINISTRATOR 		= 'administrator';
	const OBSERVER 				= 'observer';
	const NONE 					= 'none';
	
	public static function isValid($role) {
		$clazz = new \ReflectionClass(get_called_class());
		return in_array($role, $clazz->getConstants());
	}
}