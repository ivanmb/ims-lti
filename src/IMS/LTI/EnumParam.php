<?php

namespace IMS\LTI;

abstract class EnumParam {

	public static function isValid($param) {
		$clazz = new \ReflectionClass(get_called_class());
		return in_array($param, $clazz->getConstants());
	}
}