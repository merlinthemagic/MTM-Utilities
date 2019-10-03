<?php
//© 2019 Martin Peter Madsen
namespace MTM\Utilities\Factories;

class Processes
{	
	//USE: $procObj		= \MTM\Utilities\Factories::getProcesses()->__METHOD__();
	protected $_cStore=array();
	
	public function getProcOpen($strCmd=null)
	{
		$rObj	= new \MTM\Utilities\Models\Processes\ProcOpen();
		if ($strCmd !== null) {
			$rObj->setCommand($strCmd);
		}
		return $rObj;
	}
}