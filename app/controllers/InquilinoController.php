<?php
class InquilinoController extends AccessController{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function dashboard_Inquilino()
	{
		$this->data["page_title"] = "Inquilino";
	
		$this->load("VIEW","Header");
		$this->load("VIEW","Footer");
	}
	
	public function abrir_servico_manutencao()
	{
		$this->load("MODEL","TipoManutencaoModel");
		$this->load("MODEL","ImovelModel");
		$this->load("MODEL","UsuarioModel");
		
		$listaTipos = DaoEntity::getObjectArray(new TipoManutencaoModel(), "categoria asc");
		$usuario = DaoEntity::getObjectArray(new UsuarioModel(Array("id"=>$this->session->getParam("SESSIONKEY"))))[0];
		$imoveisUsuario = DaoEntity::getAssociatedObjectArray($usuario, new ImovelModel());
		
		$listaTiposData = Array();
		if(is_array($listaTipos)) foreach($listaTipos as $tipo)
			$listaTiposData[$tipo->getId()] = EnumHelper::getCategoriasDeManutencao()[$tipo->getCategoria()]." - ".$tipo->getNome();
		$this->data["listaTipos"] = $listaTiposData;
		
		$listaImoveis = Array();
		if(is_array($imoveisUsuario))
		{
			foreach($imoveisUsuario as $imovel)
			{
				$listaImoveis[$imovel->getId()] = $imovel->getIdentificador()." - ".$imovel->getNome();
			}
		}
		else
		{
			return self::doGoBackAction("Você não mora em nenhum Imóvel no momento!");
		}

		$this->data["listaImoveis"] = $listaImoveis;
	
		
		$this->data["page_title"] = "Inquilino";

		$this->load("VIEW","Header");
	
		$this->load("VIEW","ServicoManutencao_Novo");
	
		$this->load("VIEW","Footer");
	}
	
	public function salvar_novo_servico_manutencao()
	{
		$this->load("MODEL","ServicoManutencaoModel");
		$this->load("MODEL","TipoManutencaoModel");
		$this->load("MODEL","ImovelModel");
		$this->load("MODEL","UsuarioModel");
		$this->load("MODEL","EventoModel");
	
		if(array_key_exists("idImovel",$this->request_array) && ($this->request_array["idImovel"]!=null && $this->request_array["idImovel"]!=""))
		{
			$dataCorrente = Date("Y-m-d");
			
			$servico = new ServicoManutencaoModel($this->request_array);
			$servico->setDescricao(nl2br($this->request_array["descricao"]));
			$servico->setSituacao(EnumHelper::AGUARDANDO);
			$servico->setDataAbertura($dataCorrente);
			
			$servico = DaoEntity::insertObject($servico);
						
			$evento = new EventoModel();
			$evento->setDescricao("Abertura do pedido pelo Inquilino.");
			$evento->setDataDeModificacao($dataCorrente);
			$evento->setEstadoAnterior(EnumHelper::NOVO);
			$evento->setEstadoModificado(EnumHelper::AGUARDANDO);
			$evento->setValor(0);

			$evento = DaoEntity::insertObject($evento);
			
			$tipo = new TipoManutencaoModel();
			$tipo->setId($this->request_array["idTipo"]);
			
			$imovel = new ImovelModel();
			$imovel->setId($this->request_array["idImovel"]);
			
			$usuario = new UsuarioModel();
			$usuario->setId($this->session->getParam("SESSIONKEY"));
			
			DaoEntity::associateObjects($servico, $tipo);
			DaoEntity::associateObjects($servico, $evento);
			DaoEntity::associateObjects($servico, $usuario);;
			DaoEntity::associateObjects($servico, $imovel);
			DaoEntity::associateObjects($evento, $usuario);

			$this->redirect("Inquilino","listar_servicos_em_aberto");
		}
		else
		{
			$this->redirect("Inquilino","abrir_servico_manutencao");
		}
	}
	
	public function listar_servicos_em_aberto()
	{
		$this->load("MODEL", "UsuarioModel");
		$this->load("MODEL","ImovelModel");
		$this->load("MODEL", "ServicoManutencaoModel");
		
		$usuario = new UsuarioModel(Array("id"=>$this->session->getParam("SESSIONKEY")));
		$listImovel = DaoEntity::getAssociatedObjectArray($usuario, new ImovelModel(),"nome asc");
		
		$listServico = Array();
		if(is_array($listImovel)) foreach($listImovel as $imovel)
		{
				$srvs = DaoEntity::getAssociatedObjectArray($imovel, new ServicoManutencaoModel(),"id asc");
				if(is_array($srvs))
					foreach($srvs as $srv)
						if($srv->getSituacao()!="CONCLUIDO" && $srv->getSituacao()!="REPROVADO")
							array_push($listServico,$srv);
		}
		
		$listImovel = Array();
		if(is_array($listServico)) foreach($listServico as $srv)
		{
			$listImovel[$srv->getId()] = DaoEntity::getAssociatedObjectArray($srv, new ImovelModel())[0];
		}
		
		$this->data["listServico"] = $listServico;
		$this->data["listImovel"] = $listImovel;
		
		$this->data["page_title"] = "Inquilino";
		
		$this->data["sorting"] = Array("column"=>0, "order"=>"desc");
		
		$this->load("VIEW","Header");
		
		$this->load("VIEW","ServicoManutencao_Inquilino");
		
		$this->load("VIEW","Footer");
		
	}
	
	public function listar_servicos_fechados()
	{
		$this->load("MODEL", "UsuarioModel");
		$this->load("MODEL","ImovelModel");
		$this->load("MODEL", "ServicoManutencaoModel");
		
		$usuario = new UsuarioModel(Array("id"=>$this->session->getParam("SESSIONKEY")));
		$listImovel = DaoEntity::getAssociatedObjectArray($usuario, new ImovelModel(),"nome asc");
		
		$listServico = Array();
		if(is_array($listImovel)) foreach($listImovel as $imovel)
		{
				$srvs = DaoEntity::getAssociatedObjectArray($imovel, new ServicoManutencaoModel(),"id asc");
				if(is_array($srvs))
					foreach($srvs as $srv)
						if($srv->getSituacao()=="CONCLUIDO" || $srv->getSituacao()=="REPROVADO")
							array_push($listServico,$srv);
		}
		
		$listImovel = Array();
		if(is_array($listServico)) foreach($listServico as $srv)
		{
			$listImovel[$srv->getId()] = DaoEntity::getAssociatedObjectArray($srv, new ImovelModel())[0];
		}
		
		$this->data["listServico"] = $listServico;
		$this->data["listImovel"] = $listImovel;
		
		$this->data["page_title"] = "Inquilino";
		
		$this->data["sorting"] = Array("column"=>0, "order"=>"desc");
		
		$this->load("VIEW","Header");
		
		$this->load("VIEW","ServicoManutencao_Inquilino");
		
		$this->load("VIEW","Footer");
		
	}
	
	public function detalhar_servicos_em_aberto()
	{
		$this->data["page_title"] = "Inquilino";
		
		$this->load("VIEW","Header");
		
		$lista = $this->get_model_list("ServicoManutencaoModel", "nome asc");
		
		if(is_array($lista) && count($lista)==1)
		{
			$this->load("MODEL", "EventoModel");
			$this->load("MODEL", "UsuarioModel");
			$this->data["model"] = $lista[0];
			$this->data["historico_eventos"] = Array();
			$this->data["historico_eventos"]["eventos"] = DaoEntity::getAssociatedObjectArray($lista[0], new EventoModel());
			if(is_array($this->data["historico_eventos"]["eventos"]))
			{
				foreach($this->data["historico_eventos"]["eventos"] as $key=>$evento)
				{
					if(!array_key_exists("responsaveis",$this->data["historico_eventos"]))
						$this->data["historico_eventos"]["responsaveis"] = Array();
					$responsaveis = DaoEntity::getAssociatedObjectArray($evento,new UsuarioModel());
					$this->data["historico_eventos"]["responsaveis"][$key] = (is_array($responsaveis)?$responsaveis[0]: new UsuarioModel());
				}
			}
					
			$this->load("VIEW","ServicoManutencao_Inquilino_Detail");
		}
		
		$this->load("VIEW","Footer");
	}
	
	public function listar_imovel_inquilino()
	{
		$this->load("MODEL", "UsuarioModel");
		$this->load("MODEL","ImovelModel");
		$this->load("MODEL", "ServicoManutencaoModel");
		
		$usuario = new UsuarioModel(Array("id"=>$this->session->getParam("SESSIONKEY")));
		$listImovel = DaoEntity::getAssociatedObjectArray($usuario, new ImovelModel(),"nome asc");
	
		$this->data["lista"] = $listImovel;
	
		$this->data["page_title"] = "Inquilino";
		$this->load("VIEW","Header");
		$this->load("VIEW","Imovel_List_Inquilino");
		$this->load("VIEW","Footer");
	}
	
	public function detalhar_imovel_inquilino()
	{
		$this->data["page_title"] = "Inquilino";
		$this->load("VIEW","Header");
	
		$lista = $this->get_model_list("ImovelModel", "nome asc");
	
		if(is_array($lista) && count($lista)==1)
		{
			$this->data["model"] = $lista[0];
			
			$this->load("MODEL","UsuarioModel");
			
			$usuarioList = DaoEntity::getAssociatedObjectArray($lista[0], new UsuarioModel());
			$propList = Array();
			$inqList = Array();
			
			if(is_array($usuarioList)) foreach($usuarioList as $usuario)
			{
				if($usuario->getPerfil()==ServicoHelper::INQUILINO)
				{
					if($usuario->getId()!=$this->session->getParam("SESSIONKEY"))
					{
						echo $this->helper->alertBox("Imóvel não encontrado.");
						$this->load("VIEW","Footer");
						return;
					}
				}
			}
			
			if(is_array($usuarioList)) foreach($usuarioList as $usuario)
			{
				if($usuario->getPerfil()==ServicoHelper::INQUILINO)
					$inqList[$usuario->getId()] = $usuario;
				else if($usuario->getPerfil()==ServicoHelper::PROPRIETARIO)
					$propList[$usuario->getId()] = $usuario;
			}
			else
			{
				echo $this->helper->alertBox("Imóvel não encontrado.");
				$this->load("VIEW","Footer");
				return;
			}
			
			$this->data["inquilinos_list"] = $inqList;
			$this->data["proprietarios_list"] = $propList;
						
			$this->load("VIEW","Imovel_Detail_Inquilino");
		}
		else
		{
			echo $this->helper->alertBox("Imóvel não encontrado.");
		}
	
		$this->load("VIEW","Footer");
	}
	
	public function servico_manutencao_concluir()
	{
		if($this->request_array["id"]!=null && $this->request_array["id"]!="")
		{
			$this->load("MODEL","ServicoManutencaoModel");
			$this->load("MODEL","EventoModel");
			$this->load("MODEL","UsuarioModel");
			$this->load("MODEL","OrcamentoModel");
		
			$servico = new ServicoManutencaoModel($this->request_array);
			$servico = DaoEntity::getObjectArray($servico)[0];
			if($servico->getSituacao()!=EnumHelper::ANDAMENTO)
			{
				return self::doGoBackAction($this->helper->alertBox("Este Serviço não pode ser concluído!"));
			}
		
			$usuario = new UsuarioModel();
			$usuario->setId($this->session->getParam("SESSIONKEY"));
			$usuario = DaoEntity::getObjectArray($usuario)[0];
			
			$evento = new EventoModel();
			$evento->setDescricao("O serviço foi concluído pelo Inquilino ".$usuario->getNome().".");
			$evento->setDataDeModificacao(Date("Y-m-d"));
				
			$servico->setSituacao(EnumHelper::CONCLUIDO);
			
			$evento->setEstadoAnterior(EnumHelper::ANDAMENTO);
			$evento->setEstadoModificado(EnumHelper::CONCLUIDO);	
			$evento = DaoEntity::insertObject($evento);
	
			$servico = DaoEntity::updateObject($servico);
				
			DaoEntity::associateObjects($servico, $evento);
			DaoEntity::associateObjects($evento, $usuario);
		}
		
		$this->redirect("Inquilino","listar_servicos_fechados");
	}
	
}


?>
