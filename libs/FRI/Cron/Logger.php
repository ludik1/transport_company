<?php

namespace FRI\Cron;

class Logger extends \Nette\Object
{
	
	private $log;
	
	function __construct()
	{
		$this->log = '';
	}
	
	public function append($entry)
	{
		$this->log .= $entry."\n";
	}
	
	public function getLog()
	{
		return $this->log;
	}
	
}
