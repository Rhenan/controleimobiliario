<?php
class Loader {
	final public function load($type,$name)
	{
		try{
			require_once(constant($type).$name.".php");
		}
		catch(Exception $ex)
		{
			ErrorConsole::error($ex->getMessage());
		}
	}
	
	final public static function static_load($array)
	{
		if(is_array($array))
		{
			foreach($array as $type=>$names)
			{
				if(is_array($names) && !empty($names)) foreach($names as $name)
				{
					try{
						require_once(constant($type).$name.".php");
					}
					catch(Exception $ex)
					{
						ErrorConsole::error($ex->getMessage());
					}
				}
			}
		}
	}
}

?>
