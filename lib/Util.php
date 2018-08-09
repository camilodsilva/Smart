<?php
class Util {
	public static function dateIncrement(string $_format, string $_interval, $_date){
		return date($_format, strtotime($_interval, strtotime($_date)));
	}
}