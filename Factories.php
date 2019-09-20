<?php
//� 2019 Martin Peter Madsen
namespace MTM\Utilities;

class Factories
{
	private static $_cStore=array();
	
	//USE: $aFact		= \MTM\Utilities\Factories::$METHOD_NAME();
	
	public static function getTime()
	{
		if (array_key_exists(__FUNCTION__, self::$_cStore) === false) {
			self::$_cStore[__FUNCTION__]	= new \MTM\Utilities\Factories\Time();
		}
		return self::$_cStore[__FUNCTION__];
	}
	public static function getSoftware()
	{
		if (array_key_exists(__FUNCTION__, self::$_cStore) === false) {
			self::$_cStore[__FUNCTION__]	= new \MTM\Utilities\Factories\Software();
		}
		return self::$_cStore[__FUNCTION__];
	}
	public static function getGuids()
	{
		if (array_key_exists(__FUNCTION__, self::$_cStore) === false) {
			self::$_cStore[__FUNCTION__]	= new \MTM\Utilities\Factories\Guids();
		}
		return self::$_cStore[__FUNCTION__];
	}
	public static function getStrings()
	{
		if (array_key_exists(__FUNCTION__, self::$_cStore) === false) {
			self::$_cStore[__FUNCTION__]	= new \MTM\Utilities\Factories\Strings();
		}
		return self::$_cStore[__FUNCTION__];
	}
	public static function getBases()
	{
		if (array_key_exists(__FUNCTION__, self::$_cStore) === false) {
			self::$_cStore[__FUNCTION__]	= new \MTM\Utilities\Factories\Bases();
		}
		return self::$_cStore[__FUNCTION__];
	}
}