<?php
class RequestProcessor {
	private $loader;
	
	private $default_controller;
	private $default_action;
	
	public function setDefaultController($value)
	{
		$this->default_controller = $value;
	}
	
	public function setDefaultAction($value)
	{
		$this->default_action = $value;
	}
	
	public function __construct(){
		ErrorConsole::info("Starting RequestProcessor");
		
		$this->loader = new Loader();
	}
	
	private final function do_default_action()
	{
		ErrorConsole::info("Using default Controller: ".$this->default_controller);
		
		$this->loader->load("CONTROLLER",$this->default_controller);
		$action = $this->default_action;
		
		$controller = new $this->default_controller();
		$controller->request_array = Array();
		$controller->$action();
	}
	
	private final function proccess_request()
	{
		$module = "";
		$request_kid = "";
		if(isset($_GET["module"]) && isset($_GET["action"]))
		{
			$module = $_GET["module"];
			$request_kid = "GET";
		}
		else if(isset($_POST["module"]) && isset($_POST["action"]))
		{
			$module = $_POST["module"];
			$request_kid = "POST";
		}
		else
		{
			return $this->do_default_action();
		}
		
		$request_array = Array();
		if($request_kid=="GET")	foreach($_GET as $key=>$value)
		{
			$request_array[$key] = $value;
		}
		else if($request_kid=="POST")	foreach($_POST as $key=>$value)
		{
			$request_array[$key] = $value;
		}
		
		$module .= "Controller";
		
		ErrorConsole::info("Using Controller: ".$module);
		
		$this->loader->load("CONTROLLER",$module);
		$controller = new $module();
		$action = ($request_kid=="GET"?$_GET["action"]:$_POST["action"]);
		$controller->request_array = $request_array;
		
		ErrorConsole::info("Processing Action: ".$action);
		
		if($controller->invoke())
			$controller->$action();
	
	}
	
	public final function do_request()
	{
		return $this->proccess_request();
	}
	
}

?>
