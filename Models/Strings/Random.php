<?php
//© 2019 Martin Peter Madsen
namespace MTM\Utilities\Models\Strings;

class Random
{
	public function getByRegex($len, $regex="A-Za-z0-9\#\-\+\:\;\.\,\!")
	{
		$chars        = "ABCDEFGHKLMNOPQRSTUVWXYZabcdefghklmnopqrstuvwxyz0123456789!@#$%^&*()_-+=(){}[]:;,.<>?";
		$uChars       = preg_replace("/[^".$regex."]/", "", $chars);
		$charLen      = strlen($uChars) - 1;
		if (strlen($charLen) > 0) {
			$str		= "";
			for ($x=0; $x < $len; $x++) {
				$str	.= $uChars[rand(0, $charLen)];
			}
			return $str;
		} else {
			throw new \Exception("Invalid regex");
		}
	}
}