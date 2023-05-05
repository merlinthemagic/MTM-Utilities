<?php
//� 2023 Martin Peter Madsen
namespace MTM\Utilities\Tools\Validations;

class V1
{
	public function isV4Guid($input, $throw=true)
	{
		if (is_string($input) === true && preg_match("/^([A-Z0-9]{8})\-([A-Z0-9]{4})\-([A-Z0-9]{4})\-([A-Z0-9]{4})\-([A-Z0-9]{12})$/", $input) == 1) {
			return true;
		} elseif ($throw === true) {
			throw new \Exception("Not a v4 guid", 49766);
		} else {
			return false;
		}
	}
	public function isInt($input, $throw=true)
	{
		if (is_int($input) === true) {
			return true;
		} elseif ($throw === true) {
			throw new \Exception("Input is not an integer", 49767);
		} else {
			return false;
		}
	}
	public function isStrInt($input, $throw=true)
	{
		if ($this->isStr($input, false) === true && ctype_digit($input) === true) {
			return true;
		} elseif ($throw === true) {
			throw new \Exception("Input is not a string integer", 49793);
		} else {
			return false;
		}
	}
	public function isStr($input, $throw=true)
	{
		if (is_string($input) === true) {
			return true;
		} elseif ($throw === true) {
			throw new \Exception("Input is not a string", 49768);
		} else {
			return false;
		}
	}
	public function isArray($input, $throw=true)
	{
		if (is_array($input) === true) {
			return true;
		} elseif ($throw === true) {
			throw new \Exception("Input is not an array", 49772);
		} else {
			return false;
		}
	}
	public function isBoolean($input, $throw=true)
	{
		if (is_bool($input) === true) {
			return true;
		} elseif ($throw === true) {
			throw new \Exception("Input is not a boolean", 49777);
		} else {
			return false;
		}
	}
	public function isNull($input, $throw=true)
	{
		if (is_null($input) === true) {
			return true;
		} elseif ($throw === true) {
			throw new \Exception("Input is not a null value", 49782);
		} else {
			return false;
		}
	}
	public function isIpV4($input, $throw=true)
	{
		//implied decimal notation
		if ($this->isStr($input, false) === true && preg_match("/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/", $input) === 1) {
			return true;
		} elseif ($throw === true) {
			throw new \Exception("Input is not an IpV4 address", 49769);
		} else {
			return false;
		}
	}
	public function isIpV6($input, $throw=true)
	{
		//hex decimal notation implied
		//this method needs alot more validations
		if ($this->isStr($input, false) === true && preg_match("/^[0-9A-Fa-f\:]{2,39}$/", $input) === 1) {
			return true;
		} elseif ($throw === true) {
			throw new \Exception("Input is not an IpV6 address", 49789);
		} else {
			return false;
		}
	}
	public function isIp($input, $throw=true)
	{
		if ($this->isIpV4($input, false) === true || $this->isIpV6($input, false) === true) {
			return true;
		} elseif ($throw === true) {
			throw new \Exception("Input is not an IP address", 49792);
		} else {
			return false;
		}
	}
	public function isStdClass($input, $throw=true)
	{
		if ($input instanceof \stdClass === true) {
			return true;
		} elseif ($throw === true) {
			throw new \Exception("Input is not stdClass", 49770);
		} else {
			return false;
		}
	}
	public function stdPropsExist($input, $props, $throw=true)
	{
		if($this->isStdClass($input, $throw) === true && $this->isArray($props, $throw) === true) {
			foreach ($props as $index => $prop) {
				if (property_exists($input, $prop) === false) {
					if ($throw === true) {
						##dont want to leak information about the name of the property
						throw new \Exception("Input object does not have the property at index: ".$index, 49775);
					} else {
						return false;
					}
				}
			}
			return true;
		} elseif ($throw === true) {
			throw new \Exception("Input/properties are invalid", 49773);
		} else {
			return false;
		}
	}
	public function isSha256($input, $throw=true)
	{
		if (preg_match("/^[a-f0-9]{64}$/", $input) === 1) {
			return true;
		} elseif ($throw === true) {
			throw new \Exception("Input is not a sha256 hash", 49776);
		} else {
			return false;
		}
	}
	public function isSha1($input, $throw=true)
	{
		if (preg_match("/^[a-f0-9]{40}$/", $input) === 1) {
			return true;
		} elseif ($throw === true) {
			throw new \Exception("Input is not a sha1 hash", 49722);
		} else {
			return false;
		}
	}
	public function isMd5($input, $throw=true)
	{
		if ($this->isStr($input, false) === true && preg_match("/^[a-f0-9]{32}$/", $input) === 1) {
			return true;
		} elseif ($throw === true) {
			throw new \Exception("Input is not a md5 hash", 49791);
		} else {
			return false;
		}
	}
	public function isEmail($input, $throw=true)
	{
		if (\MTM\Utilities\Factories::getStrings()->getEmail()->isValid($input) === true) {
			return true;
		} elseif ($throw === true) {
			throw new \Exception("Input is not an email address", 49778);
		} else {
			return false;
		}
	}
	public function isDecimal($input, $throw=true)
	{
		if ($this->isStr($input, false) === true && preg_match("/^([0-9]+\.[0-9]+)$/", $input) === 1) {
			return true;
		} elseif ($throw === true) {
			throw new \Exception("Input is not an decimal number", 49779);
		} else {
			return false;
		}
	}
	public function isStrMax($input, $len, $throw=true)
	{
		if (is_string($input) === true && is_int($len) === true && strlen($input) <= $len) {
			return true;
		} elseif ($throw === true) {
			throw new \Exception("Input string max length invalid", 49780);
		} else {
			return false;
		}
	}
	public function isStrMin($input, $len, $throw=true)
	{
		if (is_string($input) === true && is_int($len) === true && strlen($input) >= $len) {
			return true;
		} elseif ($throw === true) {
			throw new \Exception("Input string min length invalid", 49781);
		} else {
			return false;
		}
	}
	public function isStrLen($input, $len, $throw=true)
	{
		if (is_string($input) === true && is_int($len) === true && strlen($input) === $len) {
			return true;
		} elseif ($throw === true) {
			throw new \Exception("Input string length invalid", 49788);
		} else {
			return false;
		}
	}
	public function isUsign32Int($input, $throw=true)
	{
		if (is_int($input) === true && $input > -1 && $input < 4294967296) {
			return true;
		} elseif ($throw === true) {
			throw new \Exception("Input is not an unsigned 32bit integer", 49783);
		} else {
			return false;
		}
	}
	public function isSig32Int($input, $throw=true)
	{
		if (is_int($input) === true && $input > -2147483649 && $input < 2147483648) {
			return true;
		} elseif ($throw === true) {
			throw new \Exception("Input is not a signed 32bit integer", 49784);
		} else {
			return false;
		}
	}
	public function isUsign64Int($input, $throw=true)
	{
		if (is_int($input) === true && $input > -1 && $input < 18446744073709551616) {
			return true;
		} elseif ($throw === true) {
			throw new \Exception("Input is not an unsigned 64bit integer", 49785);
		} else {
			return false;
		}
	}
	public function isSig64Int($input, $throw=true)
	{
		if (is_int($input) === true && $input > -9223372036854775809 && $input < 9223372036854775808) {
			return true;
		} elseif ($throw === true) {
			throw new \Exception("Input is not a signed 64bit integer", 49786);
		} else {
			return false;
		}
	}
	public function isHexDecimal($input, $throw=true)
	{
		if (is_string($input) === true && preg_match("/^[a-f0-9]+$/", $input) === 1) {
			return true;
		} elseif ($throw === true) {
			throw new \Exception("Input is not hex decimal string", 49787);
		} else {
			return false;
		}
	}
	public function isMacAddr($input, $throw=true)
	{
		if (preg_match("/^[a-fA-F0-9]{12}$/", $input) === 1) {
			return true;
		} elseif ($throw === true) {
			throw new \Exception("Input is not a mac address", 49788);
		} else {
			return false;
		}
	}
	public function isEpoch32($input, $throw=true)
	{
		if ($this->isSig32Int($input, false) === true && preg_match("/^(-)?([0-9]{10})$/", $input) === 1 && $input < 2147483648 && $input > -2147483649) {
			return true;
		} elseif ($throw === true) {
			throw new \Exception("Input is not an a signed 32bit epoch", 49790);
		} else {
			return false;
		}
	}
	public function isMicroEpoch32($input, $throw=true)
	{
		if (preg_match("/^(-)?([0-9]{10}\.[0-9]{6})$/", $input) === 1 && ceil($input) < 2147483648 && floor($input) > -2147483649) {
			return true;
		} elseif ($throw === true) {
			throw new \Exception("Input is not an a signed 32bit epoch with 6 decimals", 49790);
		} else {
			return false;
		}
	}
}