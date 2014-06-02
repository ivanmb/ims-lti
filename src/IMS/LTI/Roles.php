<?php

namespace IMS\LTI;

abstract class Roles extends EnumParam {
	const STUDENT 				= 'Student';
	const FACULTY 				= 'Faculty';
	const MEMBER 				= 'Member';
	const LEARNER 				= 'Learner';
	const INSTRUCTOR 			= 'Instructor';
	const MENTOR 				= 'Mentor';
	const STAFF 				= 'Staff';
	const ALUMNI 				= 'Alumni';
	const PROSPECTIVE_STUDENT 	= 'Prospectivestudent';
	const GUEST 				= 'Guest';
	const OTHER 				= 'Other';
	const ADMINISTRATOR 		= 'Administrator';
	const OBSERVER 				= 'Observer';
	const NONE 					= 'None';
	
}