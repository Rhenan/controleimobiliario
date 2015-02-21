<?php
class AcessoController extends AccessController{
	
	public function __construct(){
		parent::__construct();
		$this->load("MODEL","UsuarioModel");
		$this->data["page_title"] = "Acesso";
	}
	
	public function dashboard_Acesso()
	{
		$this->data["page_title"] = "Acesso";
		
		$this->load("VIEW","Header");
		$this->load("VIEW","Footer");
	}
	
	public function usuario_trocar_senha()
	{		
		$this->load("VIEW","Header");
		
		$alert = $this->session->getParam("alert");
		if($alert!=null)
			echo $alert;
		
		$this->load("VIEW","Usuario_Senha");
	
		$this->load("VIEW","Footer");
	}
	
	public function usuario_trocar_senha_salvar()
	{
		
		$id = $this->session->getParam("SESSIONKEY");
		$usuario = new UsuarioModel(Array("id"=>$id,"senha"=>md5($this->request_array["senha"])));
		
		$usuario = DaoEntity::getObjectArray($usuario);
		if(is_array($usuario))
		{
			$usuario = $usuario[0];
			$novaSenha = $this->request_array["novaSenha"];
			$novaSenhaConf = $this->request_array["novaSenhaConfirmar"];
			if(strlen($novaSenha)<6)
			{
				$this->session->newTempParam("alert",$this->helper->alertBox("A senha deve ter no mínino 6 caracteres."));
				$this->redirect("Acesso","usuario_trocar_senha");
				return;
			}
			
			if($novaSenha != $novaSenhaConf)
			{
				$this->session->newTempParam("alert",$this->helper->alertBox("A senha e a confirmação são diferentes."));
				$this->redirect("Acesso","usuario_trocar_senha");
				return;
			}
			
			$usuarioNovo = $usuario;
			$usuarioNovo->setSenha(md5($novaSenha));
			DaoEntity::updateObject($usuarioNovo);
		}
		else
		{
			$this->session->newTempParam("alert",$this->helper->alertBox("Senha incorreta."));
			$this->redirect("Acesso","usuario_trocar_senha");
			return;
		}
		
		$this->session->newTempParam("alert",$this->helper->successBox("Senha alterada com sucesso."));
		$this->redirect("Acesso","usuario_trocar_senha");
	}
	
	public function usuario_lista()
	{
		$this->data["page_title"] = "Acesso";
		$this->data["sorting"] = Array("column"=>1, "order"=>"asc");
		
		$this->load("VIEW","Header");
		
		$alert = $this->session->getParam("alert");
		if($alert!=null)
			echo $alert;
		
		$this->data["usuarios"] = DaoEntity::getObjectArray(new UsuarioModel());
		
		foreach($this->data["usuarios"] as $key=>$usr)
			if($usr->getStatus()=="DESATIVADO")
				unset($this->data["usuarios"][$key]);
		
		$this->load("VIEW","Usuario_List");
	
		$this->load("VIEW","Footer");
	}
	
	public function usuario_resetar_senha()
	{
		$id = $this->request_array["id"];
		$senhaPadrao = ServicoHelper::SENHA_PADRAO_ENC;
		$usuario = new UsuarioModel(Array("id"=>$id,"senha"=>$senhaPadrao));
		
		DaoEntity::updateObject($usuario);
		$usuario = DaoEntity::getObjectArray($usuario)[0];
		$this->session->newTempParam("alert",$this->helper->successBox("Senha de <b>".$usuario->getUsuario()."</b> resetada com sucesso.<br/><b>Nova senha: ".ServicoHelper::SENHA_PADRAO."</b>"));
		$this->redirect("Acesso","usuario_lista");
	}
	
	public function usuario_desativar()
	{
		$id = $this->request_array["id"];
		$usuario = new UsuarioModel(Array("id"=>$id,"status"=>ServicoHelper::USUARIO_DESATIVADO));
		$usuario = DaoEntity::updateObject($usuario);
		$this->session->newTempParam("alert",$this->helper->successBox("Usuário desativado com sucesso!"));
		$this->redirect("Acesso","usuario_lista");
	}
	
	public function criar_usuario()
	{
		$this->load("VIEW","Header");
		$this->load("VIEW","Novo_Usuario");
		$this->load("VIEW","Footer");
	}
	
	public function criar_usuario_salvar()
	{
		if($this->request_array["perfil"]=="" || $this->request_array["perfil"]==null)
		{
			self::doGoBackAction("Impossível criar usuário!");
		}
		
		$this->load("MODEL","UsuarioModel");
		
		
		$usuario = new UsuarioModel();
		$usuario->setUsuario($this->request_array["login"]);
		$usuario->setNome($this->request_array["nome"]);
		$usuario->setPerfil($this->request_array["perfil"]);
		$usuario->setSenha(ServicoHelper::SENHA_PADRAO_ENC);
		$usuario->setStatus("ATIVO");
		
		$usuario = DaoEntity::insertObject($usuario);
		
		ServicoHelper::associarServicos($usuario);
		
		$this->redirect("Acesso","usuario_lista");
	}
}

?>
