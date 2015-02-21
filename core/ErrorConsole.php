<?php

final class ErrorConsole {
	
	private static $logConsole = "";
	
	private function __construct(){}
	
	public static function info($text)
	{
		self::$logConsole .= "<p style='color:black'>[INFO] $text</p>";
	}

	public static function warn($text)
	{
		self::$logConsole .= "<p style='color:green'>[WARN] $text</p>";
	}
	
	public static function error($text)
	{
		self::$logConsole .= "<p style='color:red'>[ERROR] $text</p>";
	}
	
	public static function critical($text)
	{
		self::$logConsole .= "<p style='color:red'><b>[CRITICAL] $text</b></p>";
		Engine::abort();
	}
	
	public static function log()
	{
		echo "<div style='margin:20px;border-radius:10px;padding:20px;background-color:#e5e5e5;font-size:12px;'>";
		echo self::$logConsole;
		echo "</div>";
	}
	
}

?>
