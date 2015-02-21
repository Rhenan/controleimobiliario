<?php

class FileController extends Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load("MODEL", "UsuarioModel");
	}
	
	public function download_orcamento()
	{
		$this->load("MODEL", "OrcamentoModel");
		$this->load("MODEL", "ServicoManutencaoModel");
		$this->load("MODEL", "ImovelModel");
		
		try{
			$fpath = $this->request_array["filepath"];
			
			$orcamento = DaoEntity::getObjectArray(new OrcamentoModel(Array("pdf"=>$fpath)))[0];
			$manutencao = DaoEntity::getAssociatedObjectArray($orcamento, new ServicoManutencaoModel())[0];
			$imovel = DaoEntity::getAssociatedObjectArray($manutencao, new ImovelModel())[0];
			
			$idUsuario = $this->session->getParam("SESSIONKEY");
			if($idUsuario!=null)
			{
				$usuario = DaoEntity::getObjectArray(new UsuarioModel(Array("id"=>$idUsuario)))[0];
				if($usuario->getPerfil()==ServicoHelper::PROPRIETARIO)
					$usuario = DaoEntity::getAssociatedObjectArray($imovel, $usuario)[0];
				
				if($usuario != null && ($usuario->getPerfil()==ServicoHelper::PROPRIETARIO || $usuario->getPerfil()==ServicoHelper::GERENTE))
				{
					return File::download($fpath);
				}
			}
		}
		catch(Exception $e)
		{
			
		}
		
		$this->load("VIEW", "Page404");
	}
}

?>