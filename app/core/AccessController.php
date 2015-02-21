<?php
class AccessController extends Controller {
	public $servico_helper;
	
	public function __construct(){
		parent::__construct();
		$isLogged = $this->session->getParam("isLogged");
		$sessionkey = $this->session->getParam("SESSIONKEY");
	
		if($isLogged==null || $sessionkey==null)
		{
			$this->session->destroy();
			$this->redirect();
			return;
		}
	
		$this->load("MODEL", "UsuarioModel");
		$this->load("MODEL","ServicoModel");
	
		$services_list = DaoEntity::getAssociatedObjectArray(new UsuarioModel(Array("id"=>$sessionkey)), new ServicoModel(),"modulo asc, nome asc");
		$this->data["user_services"] = Array();
		$this->data["menu_services"] = Array();
		
		if(is_array($services_list))
		{
			foreach($services_list as $srv)
			{
				$modulo = $srv->getModulo();
				
				if(!isset($this->data["user_services"][$modulo]))
					$this->data["user_services"][$modulo] = Array();
				if(!isset($this->data["menu_services"][$modulo]))
					$this->data["menu_services"][$modulo] = Array();
				
				if($srv->getHasMenuItem()==TRUE)
				{
					array_push(
						$this->data["menu_services"][$modulo],
						Array("nome"=>$srv->getNome(),"acao"=>$srv->getAcao())
					);
				}
				
				array_push(
					$this->data["user_services"][$modulo],
					Array("nome"=>$srv->getNome(),"acao"=>$srv->getAcao())
				);
			}
		}
				
		$this->servico_helper = new ServicoHelper();
	}
	
	public final function invoke() {
		if(!$this->have_access($this->data["user_services"]))
		{
			throw new Exception("Sem permissão para acessar este módulo.");
		}
		return true;
	}
	
	protected function have_access($services_list)
	{
		if(!array_key_exists("action",$this->request_array) && !array_key_exists("module",$this->request_array))
		{
			return true;
		}
		else if($this->request_array["module"]=="Principal")
			return true;
		else if(is_array($services_list)) foreach($services_list as $modulo=>$services)
		{
			if(is_array($services)) foreach($services as $srv)
			{
				if($srv["acao"]==$this->request_array["action"] && $modulo==$this->request_array["module"])
					return true;
			}
		}
		
		return false;
	}
}

?>
