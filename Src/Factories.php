<?php
//� 2019 Martin Peter Madsen
namespace MTM\Utilities;

class Factories
{
	private static $_s=array();
	
	//USE: $aFact		= \MTM\Utilities\Factories::$METHOD_NAME();
	
	public static function getTime()
	{
		if (array_key_exists(__FUNCTION__, self::$_s) === false) {
			self::$_s[__FUNCTION__]	= new \MTM\Utilities\Factories\Time();
		}
		return self::$_s[__FUNCTION__];
	}
	public static function getSoftware()
	{
		if (array_key_exists(__FUNCTION__, self::$_s) === false) {
			self::$_s[__FUNCTION__]	= new \MTM\Utilities\Factories\Software();
		}
		return self::$_s[__FUNCTION__];
	}
	public static function getGuids()
	{
		if (array_key_exists(__FUNCTION__, self::$_s) === false) {
			self::$_s[__FUNCTION__]	= new \MTM\Utilities\Factories\Guids();
		}
		return self::$_s[__FUNCTION__];
	}
	public static function getStrings()
	{
		if (array_key_exists(__FUNCTION__, self::$_s) === false) {
			self::$_s[__FUNCTION__]	= new \MTM\Utilities\Factories\Strings();
		}
		return self::$_s[__FUNCTION__];
	}
	public static function getHashing()
	{
		if (array_key_exists(__FUNCTION__, self::$_s) === false) {
			self::$_s[__FUNCTION__]	= new \MTM\Utilities\Factories\Hashing();
		}
		return self::$_s[__FUNCTION__];
	}
	public static function getArrays()
	{
		if (array_key_exists(__FUNCTION__, self::$_s) === false) {
			self::$_s[__FUNCTION__]	= new \MTM\Utilities\Factories\Arrays();
		}
		return self::$_s[__FUNCTION__];
	}
	public static function getBases()
	{
		if (array_key_exists(__FUNCTION__, self::$_s) === false) {
			self::$_s[__FUNCTION__]	= new \MTM\Utilities\Factories\Bases();
		}
		return self::$_s[__FUNCTION__];
	}
	public static function getCallBacks()
	{
		if (array_key_exists(__FUNCTION__, self::$_s) === false) {
			self::$_s[__FUNCTION__]	= new \MTM\Utilities\Factories\CallBacks();
		}
		return self::$_s[__FUNCTION__];
	}
	public static function getProcesses()
	{
		if (array_key_exists(__FUNCTION__, self::$_s) === false) {
			self::$_s[__FUNCTION__]	= new \MTM\Utilities\Factories\Processes();
		}
		return self::$_s[__FUNCTION__];
	}
	public static function getValidations()
	{
		if (array_key_exists(__FUNCTION__, self::$_s) === false) {
			self::$_s[__FUNCTION__]	= new \MTM\Utilities\Factories\Validations();
		}
		return self::$_s[__FUNCTION__];
	}
}