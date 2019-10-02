<?php
//© 2019 Martin Peter Madsen
namespace MTM\Utilities\Factories;

class Strings
{	
	//USE: $utilObj		= \MTM\Utilities\Factories::getStrings()->__METHOD__();
	protected $_cStore=array();

	public function getRandomByRegex($len, $regex="A-Za-z0-9\#\-\+\:\;\.\,\!")
	{
		return $this->getRandom()->getByRegex($len, $regex);
	}
	public function getRandom()
	{
		if (array_key_exists(__FUNCTION__, $this->_cStore) === false) {
			$this->_cStore[__FUNCTION__]	= new \MTM\Utilities\Models\Strings\Random();
		}
		return $this->_cStore[__FUNCTION__];
	}
	public function getHashing()
	{
		if (array_key_exists(__FUNCTION__, $this->_cStore) === false) {
			$this->_cStore[__FUNCTION__]	= new \MTM\Utilities\Models\Strings\Hashing();
		}
		return $this->_cStore[__FUNCTION__];
	}
}