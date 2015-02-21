<?php
class LoginController extends Controller{
	public function __construct()
	{
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
		$this->load("MODEL", "ServicoModel");
	
		$this->data["user_services"] = DaoEntity::getAssociatedObjectArray(new UsuarioModel(Array("id"=>$sessionkey)), new ServicoModel());
	}
}

?>
