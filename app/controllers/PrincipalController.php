<?php
class PrincipalController extends AccessController {
	public function __construct()
	{
		parent::__construct();
	}	
	
	public function index()
	{
		$perfil = $this->session->getParam("perfil_usuario");
		
		if($perfil == ServicoHelper::ADMINISTRADOR)
			$perfil = ServicoHelper::ACESSO;
		
		$this->redirect($perfil,"dashboard_".$perfil);
	}
}
?>