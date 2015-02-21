<?php
/**
 * The Application constants
 */
define("SYS_CORE",BASEDIR."core/");

define("APP_DIR",BASEDIR."app/");

define("VIEW", APP_DIR."views/");
define("CONTROLLER", APP_DIR."controllers/");
define("MODEL", APP_DIR."models/");

define("LIB", APP_DIR."lib/");
define("HELPER", APP_DIR."helper/");

define("CORE",APP_DIR."core/");
define("CONF",APP_DIR."conf/");

/**
 * Custom error handle
 */

function requestShutdownHandle()
{
	if(($e=error_get_last())!=null)
	{
		$errormsg = $e["message"];
		$errorfile = $e["file"];
		$errorline = $e["line"];
		
		$e_msg = "PHP Error: ".$errormsg."<br/>On ".$errorfile."<br/>At line: ".$errorline;
		ErrorConsole::critical($e_msg);
		
		
	}
}

function requestErrorHandle($errorno, $errormsg, $errorfile, $errorline, $errorcontext)
{
	switch($errorno)
	{
		case E_COMPILE_ERROR || E_ERROR:
			//echo "<h2 style='margin:20px;'>HTTP 404</h2><p style='margin-left:20px;'>The Request Page was not found or is unnavaliable now.</p>";
			$e_msg = "PHP Error: ".$errormsg."<br/>On ".$errorfile."<br/>At line: ".$errorline;
			ErrorConsole::critical($e_msg);
			break;
		default:
			$e_msg = "PHP Error: ".$errormsg."<br/>On ".$errorfile."<br/>At line: ".$errorline;
			ErrorConsole::error($e_msg);
			break;
	}
}

ini_set('display_errors', false);
set_error_handler("requestErrorHandle");
register_shutdown_function('requestShutdownHandle');
