<?php
//© 2019 Martin Peter Madsen
namespace MTM\Utilities\Factories;

class Bases
{	
	//USE: $utilObj		= \MTM\Utilities\Factories::getBases()->__METHOD__();
	protected $_cStore=array();
	
	public function getBase26()
	{
		if (array_key_exists(__FUNCTION__, $this->_cStore) === false) {
			$this->_cStore[__FUNCTION__]	= new \MTM\Utilities\Models\Bases\Base26();
		}
		return $this->_cStore[__FUNCTION__];
	}
}