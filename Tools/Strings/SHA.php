<?php
//© 2020 Martin Peter Madsen
namespace MTM\Utilities\Tools\Strings;

class SHA
{
	public function isValid256($str)
	{
		if (preg_match("/^([0-9a-fA-F]{64})$/", $str) === 1) {
			return true;
		} else {
			return false;
		}
	}
	public function isValid512($str)
	{
		if (preg_match("/^([0-9a-fA-F]{128})$/", $str) === 1) {
			return true;
		} else {
			return false;
		}
	}
}