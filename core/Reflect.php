<?php

class Reflect {
	public static function call($class, $method, $args = null) {
		// instantiation
	    $reflectionMethod = new ReflectionMethod($class, $method);
	    $reflectionMethod->invoke(null, $args);
	}
}