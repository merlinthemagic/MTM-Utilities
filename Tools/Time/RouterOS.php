<?php
//© 2019 Martin Peter Madsen
namespace MTM\Utilities\Tools\Time;

class RouterOS extends \MTM\Utilities\Tools\Base
{
	public function getUptimeInSeconds($input)
	{
		//inputs:
		//52w2d21h18m33s

		$secs	= 0;
		if (preg_match("/([0-9]+)w/", $input, $raw) === 1) {
			$secs	+= intval($raw[1]) * 604800;
		}
		if (preg_match("/([0-9]+)d/", $input, $raw) === 1) {
			$secs	+= intval($raw[1]) * 86400;
		}
		if (preg_match("/([0-9]+)h/", $input, $raw) === 1) {
			$secs	+= intval($raw[1]) * 3600;
		}
		if (preg_match("/([0-9]+)m/", $input, $raw) === 1) {
			$secs	+= intval($raw[1]) * 60;
		}
		if (preg_match("/([0-9]+)s/", $input, $raw) === 1) {
			$secs	+= intval($raw[1]);
		}
		return $secs;
	}
	public function getWlanRegistrationInSeconds($input)
	{
		//inputs:
		//12:31:45
		//2d 00:31:45
		$secs	= 0;
		if (preg_match("/([0-9]+)w/", $input, $raw) === 1) {
			$secs	+= intval($raw[1]) * 604800;
		}
		if (preg_match("/([0-9]+)d/", $input, $raw) === 1) {
			$secs	+= intval($raw[1]) * 86400;
		}
		if (preg_match("/([0-9]{2})\:([0-9]{2})\:([0-9]{2})/", $input, $raw) === 1) {
			$secs	+= intval($raw[1]) * 3600;
			$secs	+= intval($raw[2]) * 60;
			$secs	+= intval($raw[3]);
		} else {
			throw new \Exception("Invalid input");
		}
		return $secs;
	}
}