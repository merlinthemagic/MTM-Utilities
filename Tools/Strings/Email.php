<?php
//© 2020 Martin Peter Madsen
namespace MTM\Utilities\Tools\Strings;

class Email
{
	public function isValid($str)
	{
		if (is_string($str) === true && preg_match('/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/', $str) == 1) {
			return true;
		}
		return false;
	}
}