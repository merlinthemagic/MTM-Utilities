<?php
//© 2019 Martin Peter Madsen
namespace MTM\Utilities\Tools\Software;

class Php extends \MTM\Utilities\Tools\Base
{
	protected $_bShell=null;
	protected $_iShell=null;
	
	public function getShell()
	{
		if ($this->_bShell === null) {
			//this is a shared 'sh' shell
			$this->_bShell	= \MTM\Utilities\Factories::getSoftware()->getShellTool()->getSH();
		}
		return $this->_bShell;
	}
	public function getInteractiveShell()
	{
		if ($this->_iShell === null) {
			$path	= \MTM\Utilities\Factories::getSoftware()->getOsTool()->getExecutablePath("php");
			if ($path === false) {
				throw new \Exception("Executable for php does not exist");
			} else {
				$this->_iShell	= \MTM\Utilities\Factories::getProcesses()->getProcOpen($path . " -a");
			}
		}
		return $this->_iShell;
	}
}