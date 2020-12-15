<?php
//© 2020 Martin Peter Madsen
namespace MTM\Utilities\Tools\CallBacks;

class Process
{
	protected $_loopCbs=array();
	protected $_lastEvent=0; //last time a call back resulted in an event
	protected $_maxIdle=2; //in seconds
	protected $_idleSleep=10000;//in micro secs
	protected $_runStatus=false;
	
	public function addLoopCb($obj, $method)
	{
		//method should return an integer.
		//if anything was processed then 1 else 0
		//this will help this tool slowdown if every callback is idling
		if (is_object($obj) === false) {
			throw new \Exception("Invalid input, object expected");
		} elseif (is_string($method) === false) {
			throw new \Exception("Invalid input, string expected");
		} elseif (method_exists($obj, $method) === false) {
			throw new \Exception("Invalid input, object does not contain method");
		}
		$this->removeLoopCb($obj, $method);
		$this->_loopCbs[]	= array($obj, $method);
		$this->resetRunStatus();
		return $this;
	}
	public function removeLoopCb($obj, $method)
	{
		foreach ($this->_loopCbs as $e => $eObj) {
			if ($eObj[0] === $obj && $eObj[1] === $method) {
				unset($this->_loopCbs[$e]);
				$this->resetRunStatus();
				break;
			}
		}
		return $this;
	}
	public function runLoop($runTime=-1)
	{
		if ($this->_runStatus === false) {
			throw new \Exception("Need at least one call back");
		}
		if ($runTime < 0) {
			while($this->_runStatus === true) {
				$this->runOnce();
			}
		} else {
			$cTime	= \MTM\Utilities\Factories::getTime()->getMicroEpoch();
			$tTime	= $cTime + $runTime;
			while($this->_runStatus === true && $tTime > $cTime) {
				$this->runOnce();
				$cTime	= \MTM\Utilities\Factories::getTime()->getMicroEpoch();
			}
		}
	}
	public function runOnce()
	{
		$cTime		= \MTM\Utilities\Factories::getTime()->getMicroEpoch();
		$count		= 0;
		foreach ($this->_loopCbs as $cbObj) {
			
			$rData	= call_user_func_array($cbObj, array());
			if (is_int($rData) === true) {
				$count	+= $rData;
			}
		}
		if ($count > 0) {
			$this->_lastEvent	= $cTime;
		} elseif (($this->_lastEvent + $this->_maxIdle) < $cTime) {
			//slow down we have not received a message in awhile
			usleep($this->_idleSleep);
		}
		return $count;
	}
	public function terminate($throw=false)
	{
		$this->_runStatus	= false;
		return $this;
	}
	protected function resetRunStatus()
	{
		if (count($this->_loopCbs) > 0) {
			$this->_runStatus		= true;
		} else {
			$this->_runStatus		= false;
		}
	}
}