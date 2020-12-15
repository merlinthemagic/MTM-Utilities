<?php
//© 2019 Martin Peter Madsen
namespace MTM\Utilities\Factories;

class CallBacks
{	
	//USE: $utilObj		= \MTM\Utilities\Factories::getCallBacks()->__METHOD__();
	
	protected $_s=array();

	public function getProcess()
	{
		
		//allows methods to register themselves for callbacks, but your entire app must use it
		//if you want to execute logic in between runs
		if (array_key_exists(__FUNCTION__, $this->_s) === false) {
			$this->_s[__FUNCTION__]	= new \MTM\Utilities\Tools\CallBacks\Process();
		}
		return $this->_s[__FUNCTION__];
	}
}