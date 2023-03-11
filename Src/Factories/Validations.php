<?php
//� 2019 Martin Peter Madsen
namespace MTM\Utilities\Factories;

class Validations
{	
	//USE: $utilObj		= \MTM\Utilities\Factories::getValidations()->__METHOD__();
	
	protected $_s=array();

	public function getV1()
	{
		//Can also be used as parent of a class
		if (array_key_exists(__FUNCTION__, $this->_s) === false) {
			$this->_s[__FUNCTION__]	= new \MTM\Utilities\Tools\Validations\V1();
		}
		return $this->_s[__FUNCTION__];
	}
}