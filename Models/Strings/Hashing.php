<?php
//© 2019 Martin Peter Madsen
namespace MTM\Utilities\Models\Strings;

class Hashing
{
	public function getAsInteger($str, $max=PHP_INT_MAX)
	{
		//convert a string into a "unique" hash consisting only of integers
		//that is less than or equal to the max
		if ($max > PHP_INT_MAX) {
			//enforce max or the compare below will have undefined behavior
			throw new \Exception("Max value cannot exceed MAX INT");
		}
		$val	= trim(preg_replace("/([^0-9]+)/", "", $this->getSha512($str)), "0");
		if ($val == "") {
			$val	= "0"; //no digits in hash
		}
		$rVal	= "";
		foreach (str_split($val, 1) as $digit) {
			$nVal	= $rVal . $digit;
			if ($nVal < $max) {
				$rVal	= $nVal;
			} else {
				break;
			}
		}
		return intval($rVal);	
	}
	public function getSha256($str)
	{
		if (is_string($str) === false) {
			throw new \Exception("Invalid Input");
		}
		return hash("sha256", $str);
	}
	public function getSha512($str)
	{
		if (is_string($str) === false) {
			throw new \Exception("Invalid Input");
		}
		return hash("sha512", $str);
	}
}