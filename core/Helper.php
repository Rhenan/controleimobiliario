<?php
class Helper {
	public function alertBox($message)
	{
		return "<div id='alert-box'>$message</div>";
	}
	
	public function successBox($message)
	{
		return "<div id='success-box'>$message</div>";
	}
	
	public function link($url,$text,$onclick=null)
	{
		return "<a href='$url' ".($onclick!=null?"onclick=\"$onclick\"":"").">$text</a>";
	}
	
	public function open_form($name,$action,$method=null,$onsubmit=null)
	{
		$form = "<form enctype='multipart/form-data' name='$name' action='$action'";
		
		if($method!=null)
			$form .= " method='$method'";
		else
			$form .= " method='POST'";
		
		if($onsubmit!=null)
			$form .= " onsubmit='$onsubmit'";
		
		$form .= ">";
		
		return $form;
	}
	
	public function close_form()
	{
		return "</form>";
	}
	
	public function hidden($name,$value)
	{
		return "<input type='hidden' name='$name' value='$value' />";
	}
	
	public function button($value,$onclick=null)
	{
		return "<input type='button' value='$value' ".($onclick!=null?" onclick='$onclick' ":"")."/>";
	}
	
	public function input($name,$type,$value=null)
	{
		$input = "<input type='$type' name='$name'";
		if($value!=null)
			$input .= " value='$value'";
		
		$input .= " />";
		
		return $input;
	}
	
	public function radio($name,$label,$value,$default=false)
	{
		$input = "<input type='radio' name='$name'";
		$input .= " value='$value'";
		
		if($default)
			$input .= " checked='checked'";
		
		$input .= ">$label</input>";
	
		return $input;
	}
	
	public function textarea($name,$rows=5,$cols=20,$value=null,$disabled="")
	{
		$input = "<textarea name='$name' rows='$rows' cols='$cols' style='resize:none;' $disabled>";
		if($value!=null)
			$input .= "$value";
	
		$input .= "</textarea>";
	
		return $input;
	}
	
	public function combo($name,$param_arr,$default=null,$white=false)
	{
		$combo = "<select name='$name'>";
		if($white) $combo .= "<option value=''></option>";
		if(is_array($param_arr)) foreach($param_arr as $key=>$text)
		{
			$combo .= "<option value='$key' ".($default==$key?"selected":"").">$text</option>";	
		}
		$combo .= "</select>";
		
		return $combo;
	}
	
	public function submit($value,$class=null)
	{
		return "<input type='submit' value='$value' ".($class!=null?"class='$class'":"")."/>";
	}
		
	public function moneyMask($money)
	{
		return number_format($money, 2, ',', ' ');
	}
	
	public function dataMask($data)
	{
		return Date("d/m/Y",strtotime($data));
	}
	
	public function dataUnmask($data)
	{
		return Date("Y-m-d",strtotime($data));
	}
}

?>
