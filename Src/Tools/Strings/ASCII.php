<?php
//� 2022 Martin Peter Madsen
namespace MTM\Utilities\Tools\Strings;

class ASCII
{
	//something happened to the formatting of this line and it does not seem to work any longer
	protected $_findV1=array("/[�-�]/","/�/","/�/","/[�-�]/","/[�-�]/","/�/","/�/","/[�-��]/","/�/","/[�-�]/","/[�-�]/","/[�-�]/","/�/","/�/","/[�-�]/","/[�-�]/","/�/","/�/","/[�-��]/","/�/","/[�-�]/","/[�-�]/");
	protected $_replaceV1=array("A","AE","C","E","I","D","N","O","X","U","Y","a","ae","c","e","i","d","n","o","x","u","y");
	
	public function replaceV1($str)
	{
		//converts non-printable to ASCII, without having to install the international package
		if (is_string($str) === false) {
			throw new \Exception("Invalid input");
		}
		//src: https://stackoverflow.com/questions/9720665/how-to-convert-special-characters-to-normal-characters
		$newStr		= preg_replace($this->_findV1, $this->_replaceV1, $str);
		return $newStr;
	}
	public function removeV1($str)
	{
		//removes non-printable ASCII chars
		if (is_string($str) === false) {
			throw new \Exception("Invalid input");
		}
		//http://www.columbia.edu/kermit/ascii.html
		$output		= "";
		foreach (str_split($str, 1) as $chr) {
			$ord	= ord($chr);
			if ($ord > 31 && $ord < 127) {
				$output		.= $chr;
			}
		}
		return $output;
	}
	public function replaceV2($str)
	{
		//converts non-printable to ASCII and converts accents
		if (is_string($str) === false) {
			throw new \Exception("Invalid input", 1111);
		} elseif (function_exists("iconv") === false) {
			throw new \Exception("iconv function not available", 1111);
		}
		
		$str	= iconv("UTF-8", "ASCII//TRANSLIT//IGNORE", $str);
		return preg_replace("/[^\x20-\x7E]/", "", $str);
	}
}