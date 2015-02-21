<?php
class IndexController extends Controller{
	
	public function __construct(){
		parent::__construct();
		$isLogged = $this->session->getParam("isLogged");
		$sessionkey = $this->session->getParam("SESSIONKEY");
		
		if($isLogged==TRUE && $sessionkey!=null)
			$this->redirect("Principal","index");
		
		return;
	}
	
	public function index()
	{
		$this->alert = $this->session->getParam("alert");
		$this->load("VIEW", "Index");
	}
	
	public function submit()
	{		
		$this->load("MODEL", "UsuarioModel");
		
		if(isset($this->request_array["usuario"]))
		{
			$usuario = new UsuarioModel($this->request_array);
			$usuario->setSenha(md5($this->request_array["senha"]));
			
			if($usuario->getUsuario()!="" && $usuario->getSenha()!="")
			{
				$usuarios = DaoEntity::getObjectArray($usuario);
				if($usuarios!=null)
				{
					$usuario = $usuarios[0];
					
					if($usuario->getStatus()==ServicoHelper::USUARIO_ATIVO)
					{	
						$this->session->newParam("isLogged", TRUE);
						$this->session->newParam("SESSIONKEY", $usuario->getId());
						$this->session->newParam("perfil_usuario", $usuario->getPerfil());
					
						$this->redirect("Principal","index");
					}
					else
					{	
						$this->session->newTempParam("alert", $this->helper->alertBox("Usuário não encontrado.<br/>Verifique seu login e senha."));
						$this->redirect("Index","index");
					}
				}
				else
				{
					$usuario = null;
					$this->session->newTempParam("alert", $this->helper->alertBox("Usuário não encontrado.<br/>Verifique seu login e senha."));
					$this->redirect("Index","index");
				}
			}
			else
			{
				$this->session->newTempParam("alert", $this->helper->alertBox("Erro ao logar."));
				$this->redirect("Index","index");
			}
		}
	}
	
	public function logout()
	{
		$this->session->destroy();
		$this->redirect();
	}
}

?>
