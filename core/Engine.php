<?php

class Engine {
	public static function start()
	{
		require("core/conf.php");
		require("core/apploader.php");

		ErrorConsole::info("Starting Application.");

		$default_controller = DEFAULT_CONTROLLER;
		$default_action = DEFAULT_ACTION;
		
		ErrorConsole::info("Processing Request.");
		
		$request_processor = new RequestProcessor();		
		$request_processor->setDefaultController($default_controller);
		$request_processor->setDefaultAction($default_action);
		$request_processor->do_request();
		
		if(defined("ERROR_CONSOLE") && ERROR_CONSOLE == 1)
			ErrorConsole::log();
		
	}
	
	public static function abort()
	{
		ErrorConsole::log();
		exit;
	}
}
