<?php
	class FormBuilder {
		
		private $form_header, $form_lines, $form_footer;
		private $is_empty;
		
		/**
		 * Use the following structure to generate a complete form.
		 * 
		 * Array
		 * [ 
		 * 		"name" => Array
		 * 		[
		 * 			"label" => $label,
		 * 			"type" => $type,
		 * 			"options" => $opts, //Just need to be set to radio or select
		 * 			"value" => $value
		 * 		]
		 * ]
		 *
		 * @param String $name 		 
		 * @param String $action
		 * @param String $method
		 * @param Array $params
		 * @param String $submit_text
		 * @param string $confirm_function
		 * 
		 **/
		
		public function __construct($name,$action,$method,$params, $submit_text,$confirm_function=null)
		{
			if(is_array($params) && !empty($params))
			{
				$this->is_empty = false;
				
				$this->form_header = "<form name='$name' action='$action' method='$method' ";
				if($confirm_function!=null) 
					$this->form_header .= "onsubmit='return $confirm_function()'";
				
				$this->form_header .= ">";
				
				$this->form_header .= "<table class='form_table'>";
				
				$this->form_lines = "";
				foreach($params as $key=>$param_line)
				{
					$this->form_lines .= self::getField(
						$key,
						(array_key_exists("label",$param_line) ? $param_line["label"] : ""),
						$param_line["type"],
						(array_key_exists("options", $param_line) ? $param_line["options"] : null),
						$param_line["value"]
					);
				}
			}
			else
				$is_empty = true;	
			
			$this->form_footer = "</table><input type='submit' value='$submit_text' />";
			$this->form_footer .= "</form>";
		}
		
		private function getField($name,$label,$type,$opts=null,$value)
		{
			$return_str = "";
			
			if($type=="hidden")
			{
				$return_str .= "<input type='$type' name='$name' value='$value' />";	
			}
			else
			{
				$return_str .= "<tr><td>$label</td><td>";
				
				if($type == "text")
				{
					$return_str .= "<input type='$type' name='$name' value='$value' /></td></tr>";
				}
				else if($type == "password")
				{
					$return_str .= "<input type='$type' name='$name' /></td></tr>";
				}
				else if($type == "textarea")
				{	
					$return_str .= "<textarea name='$name' >$value</textarea></td></tr>";
				}
				else if($type == "radio")
				{
					return "";
				}
				else if($type == "select")
				{
					$return_str .= "<select name='$name'>";
					if(is_array($opts) && !empty($opts))
						foreach($opts as $opt)
							$return_str .= "<option value='".$opt["value"]."' ".($opt["value"]==$value?"selected":"").">".$opt["text"]."</option>";
					$return_str .= "</select></td></tr>";
				}
				else
					return "";
			}
					
			return $return_str;
		}
		
		public function getForm()
		{
			return $this->form_header . $this->form_lines . $this->form_footer;
		}
		
	}