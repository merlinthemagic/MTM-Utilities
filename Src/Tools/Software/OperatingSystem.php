<?php
//� 2019 Martin Peter Madsen
namespace MTM\Utilities\Tools\Software;

class OperatingSystem extends \MTM\Utilities\Tools\Base
{
	public function getType()
	{
		if (array_key_exists(__FUNCTION__, $this->_s) === false) {
			
			if (defined("PHP_OS_FAMILY") === true) {
				$this->_s[__FUNCTION__]	= strtolower(PHP_OS_FAMILY);
			} else {
				$os			= php_uname();
				if (preg_match("/^Linux\s/i", $os) == 1) {
					$this->_s[__FUNCTION__]	= "linux";
				} else {
					throw new \Exception("Not handled");
				}
			}
		}
		return $this->_s[__FUNCTION__];
	}
	public function getDistributionId()
	{
		if (array_key_exists(__FUNCTION__, $this->_s) === false) {
			
			if ($this->getType() === "linux") {
				$strCmd		= "cat /etc/os-release";
				$rData		= trim($this->exeCmd($strCmd));
				$lines		= array_values(array_filter(array_map("trim", explode("\n", $rData))));
				foreach ($lines as $line) {
					if (preg_match("/^ID\=(.+)$/", $line, $raw) === 1) {
						$this->_s[__FUNCTION__]	= strtolower(trim($raw[1], "\""));
						break;
					}
				}
				if (array_key_exists(__FUNCTION__, $this->_s) === false) {
					throw new \Exception("Failed to determine distribution ID");
				}

			} else {
				throw new \Exception("Not handled");
			}
		}
		return $this->_s[__FUNCTION__];
	}
	public function getArchitecture()
	{
		if (array_key_exists(__FUNCTION__, $this->_s) === false) {
			
			if ($this->getType() === "linux") {
				$strCmd		= "uname -m";
				$rData		= trim($this->exeCmd($strCmd));
				if ($rData === "aarch64") {
					$rData	= "arm64";
				} elseif ($rData === "aarch32") {
					$rData	= "arm32";
				}
				$this->_s[__FUNCTION__]	= $rData;
			} else {
				throw new \Exception("Not handled");
			}
		}
		return $this->_s[__FUNCTION__];
	}
	public function getExecutablePath($name)
	{
		$hId	= hash("sha256", __FUNCTION__ . $name);
		if (array_key_exists($hId, $this->_s) === false) {
			if ($this->getType() == "linux") {
				$strCmd		= "which " . $name;
				$path		= trim($this->exeCmd($strCmd, false));
				if (strlen($path) > 0) {
					$this->_s[$hId]	= $path;	
				} else {
					//dunno why, but even for root which sometimes fails
					$strCmd		= "whereis " . $name;
					$path		= trim($this->exeCmd($strCmd, false));
					if (preg_match("/".$name."\:\s(\/.*\/".$name.")\s/", $path, $raw) === 1) {
						$this->_s[$hId]	= trim($raw[1]);
					} else {
						$this->_s[$hId]	= false;
					}
				}
				
			} else {
				throw new \Exception("Not handled");
			}
		}
		return $this->_s[$hId];
	}
	public function maxThreadCount()
	{
		//max amout of thread the os can handle
		if (array_key_exists(__FUNCTION__, $this->_s) === false) {
			if ($this->getType() == "linux") {
				
				$catPath		= $this->getExecutablePath("cat");
				if ($catPath !== false) {
					$strCmd		= $catPath . " /proc/sys/kernel/threads-max";
					$data		= trim($this->exeCmd($strCmd));
					if (preg_match("/^([0-9]+)$/", $data) == 1) {
						$this->_s[__FUNCTION__]	= intval($data);
					} else {
						throw new \Exception("Invalid return");
					}
					
				}  else {
					throw new \Exception("Missing Cat application");
				}
				
			} else {
				throw new \Exception("Not handled");
			}
		}
		return $this->_s[__FUNCTION__];
	}
	public function maxPidValue()
	{
		//max value the pid can take on the OS
		if (array_key_exists(__FUNCTION__, $this->_s) === false) {
			if ($this->getType() == "linux") {
				
				$catPath		= $this->getExecutablePath("cat");
				if ($catPath !== false) {
					$strCmd		= $catPath . " /proc/sys/kernel/pid_max";
					$data		= trim($this->exeCmd($strCmd));
					if (preg_match("/^([0-9]+)$/", $data) == 1) {
						$this->_s[__FUNCTION__]	= intval($data);
					} else {
						throw new \Exception("Invalid return");
					}

				}  else {
					throw new \Exception("Missing Cat application");
				}
				
			} else {
				throw new \Exception("Not handled");
			}
		}
		return $this->_s[__FUNCTION__];
	}
	public function pidRunning($pid)
	{
		//no caching
		if ($this->getType() == "linux") {
			
			$killPath		= $this->getExecutablePath("kill");
			if ($killPath !== false) {
				$strCmd		= "(".$killPath." -0 ".$pid." 2> /dev/null && echo \"Alive\" ) || echo \"Dead\"";
				$data		= trim($this->exeCmd($strCmd));
				if ($data == "Alive") {
					return true;
				} elseif ($data == "Dead") {
					return false;
				} else {
					throw new \Exception("Invalid return");
				}
				
			}  else {
				throw new \Exception("Missing Kill application");
			}

		} else {
			throw new \Exception("Not handled");
		}
	}
	public function sigIntPid($pid, $timeout=5000, $delay=null)
	{
		//no caching
		if ($this->pidRunning($pid) === true) {
			
			if ($this->getType() == "linux") {
				
				//kill check done by pidRunning()
				$killPath		= $this->getExecutablePath("kill");
				if ($delay === null) {
					$strCmd		= $killPath . " -SIGINT " . $pid;
					$this->exeCmd($strCmd);

					$tTime	= $this->getTime() + ($timeout / 1000);
					while (true) {
						if ($this->pidRunning($pid) === false) {
							break;
						} elseif ($this->getTime() >= $tTime) {
							throw new \Exception("Failed to SIGINT PID: " . $pid);
						}
					}
					
				} else {
					//the kill should be executed at a delay
					$strCmd	= "( sleep ".$delay."s && (".$killPath." -0 ".$pid." 2> /dev/null && ".$killPath." -SIGINT ".$pid." & ) & ) > /dev/null 2>&1";
					$this->exeCmd($strCmd);
				}
			} else {
				throw new \Exception("Not handled");
			}
		}
	}
	public function sigTermPid($pid, $timeout=5000, $delay=null)
	{
		//no caching
		if ($this->pidRunning($pid) === true) {
			
			if ($this->getType() == "linux") {
				
				//kill check done by pidRunning()
				$killPath		= $this->getExecutablePath("kill");
				if ($delay === null) {
					$strCmd		= $killPath . " -SIGTERM " . $pid;
					$this->exeCmd($strCmd);
					
					$tTime	= $this->getTime() + ($timeout / 1000);
					while (true) {
						if ($this->pidRunning($pid) === false) {
							break;
						} elseif ($this->getTime() >= $tTime) {
							throw new \Exception("Failed to SIGTERM PID: " . $pid);
						}
					}
					
				} else {
					//the kill should be executed at a delay
					$strCmd	= "( sleep ".$delay."s && (".$killPath." -0 ".$pid." 2> /dev/null && ".$killPath." -SIGTERM ".$pid." & ) & ) > /dev/null 2>&1";
					$this->exeCmd($strCmd);
				}
			} else {
				throw new \Exception("Not handled");
			}
		}
	}
	public function sigKillPid($pid, $timeout=5000, $delay=null)
	{
		//no caching
		if ($this->pidRunning($pid) === true) {
			
			if ($this->getType() == "linux") {
				
				//kill check done by pidRunning()
				$killPath		= $this->getExecutablePath("kill");
				if ($delay === null) {
					$strCmd		= $killPath . " -SIGKILL " . $pid;
					$this->exeCmd($strCmd);
					
					$tTime	= $this->getTime() + ($timeout / 1000);
					while (true) {
						if ($this->pidRunning($pid) === false) {
							break;
						} elseif ($this->getTime() >= $tTime) {
							throw new \Exception("Failed to SIGKILL PID: " . $pid);
						}
					}
					
				} else {
					//the kill should be executed at a delay
					$strCmd	= "( sleep ".$delay."s && (".$killPath." -0 ".$pid." 2> /dev/null && ".$killPath." -SIGKILL ".$pid." & ) & ) > /dev/null 2>&1";
					$this->exeCmd($strCmd);
				}
			} else {
				throw new \Exception("Not handled");
			}
		}
	}
}