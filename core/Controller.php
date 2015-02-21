<?php
class Controller extends Loader{
	
	public $request_array;
	public $helper;
	public $alert;
	public $session;
	public $data;
	
	public function __construct()
	{
		$this->helper = new Helper();
		$this->session = new Session();
		$this->data = Array();
		
		$this->alert = "";
	}
	
	public function invoke()
	{
		return true;
	}
	
	public final function redirect($controller=null,$action=null)
	{
		if($controller==null||$action==null)
		{
			header("location:index.php");
			return;
		}

		header("location:index.php?module=$controller&action=$action");
	}
	
	public final function redirectRequest($param_array)
	{
		$first = true;
		$request_url = "index.php?";
		
		if($param_array!=null)
		{
			if(is_array($param_array) && !empty($param_array)) foreach($param_array as $key=>$value)
			{
				if($first)
					$first = false;
				else
					$request_url .= "&";
				
				$request_url .= "$key=$value";
					
			}
		}
		
		header("location:$request_url");
	}
	
	protected final function get_model_list($model,$order=null)
	{
		$this->load("MODEL", $model);
	
		$lista = null;
		if(isset($this->request_array["pesquisa"]))
			$lista = DaoEntity::getObjectArrayLike(new $model($this->request_array),$order);
		else
			$lista = DaoEntity::getObjectArray(new $model($this->request_array),$order);
	
		return $lista;
	}
	
	protected final function insert_model($model)
	{
		$this->load("MODEL", $model);
		
		$model = new $model($this->request_array);
		$this->request_array = null;
		return DaoEntity::insertObject($model);
	}
	
	protected final function update_model($model)
	{
		$this->load("MODEL", $model);
	
		$model = new $model($this->request_array);
		$this->request_array = null;
		return DaoEntity::updateObject($model);
	}
	
	protected final function delete_model($model)
	{
		$this->load("MODEL", $model);
		
		$model = new $model($this->request_array);
		$this->request_array = null;
		return DaoEntity::removeObject($model);
	}
	
	protected function doGoBackAction($alertMsg,$module=null)
	{
		$this->data["page_title"] = "$module";
		$this->load("VIEW","Header");
		$this->data["error_msg"] = $alertMsg;
		$this->load("VIEW","GoBackPage");
		$this->load("VIEW","Footer");
	}
	
}

?>