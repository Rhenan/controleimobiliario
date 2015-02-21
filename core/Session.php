<?php
class Session {
	private $session;
	
	public function __construct()
	{
		ErrorConsole::info("Using Session object");
		
		if(isset($_SESSION))
			$this->session = $_SESSION;
		else
			$this->session = Array();
	}
	
	public final function newParam($key,$value)
	{
		$this->session[$key] = $value;
	}
	
	public final function newTempParam($key,$value)
	{
		$this->session[$key] = Array("timeout"=>1,"value"=>$value);
	}
	
	public final function getParam($key)
	{
		$value = null;
		
		if(isset($this->session[$key]))
		{
			$value = $this->session[$key];
			if(is_array($value))
			{
				$timeout = $value["timeout"];
				$value = $value["value"];
				
				if($timeout<=1)
					unset($this->session[$key]);
			}
		}
		
		ErrorConsole::info("Session[$key] retrieved");
		
		return $value;
	}
	
	public final function destroy()
	{
		session_destroy();
	}
	
	public function __destruct()
	{
		$_SESSION = $this->session;
	}
	
}