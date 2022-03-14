<?php
//© 2019 Martin Peter Madsen
namespace MTM\Utilities\Factories;

class Processes
{	
	//USE: $procObj		= \MTM\Utilities\Factories::getProcesses()->__METHOD__();
	protected $_s=array();
	
	public function getProcOpen($strCmd=null)
	{
		$rObj	= new \MTM\Utilities\Models\Processes\ProcOpen();
		if ($strCmd !== null) {
			$rObj->setCommand($strCmd);
		}
		return $rObj;
	}
	public function getBashShell($shared=true)
	{
		if ($shared === true) {
			if (array_key_exists(__FUNCTION__, $this->_s) === false) {
				$this->_s[__FUNCTION__]	= new \MTM\Utilities\Models\Processes\BashShell\Zstance();
			}
			return $this->_s[__FUNCTION__];
		} else {
			return new \MTM\Utilities\Models\Processes\BashShell\Zstance();
		}
	}
}