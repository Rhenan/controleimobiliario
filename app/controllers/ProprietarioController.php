<?php
	class ProprietarioController extends AccessController {
		
		public function __construct(){
			parent::__construct();
			
			$this->data["page_title"] = "Proprietário";
		}
		
		public function dashboard_Proprietario()
		{
			$this->load("MODEL","ServicoManutencaoModel");
		
			$manutencao = new ServicoManutencaoModel();
			$manutencao->setSituacao(EnumHelper::APROVACAO);
			$this->data["manutencoes_aprovacao"] = DaoEntity::getObjectArray($manutencao,"id desc");
		
			$this->load("VIEW","Header");
			$this->load("VIEW","Dashboard_Proprietario");
			$this->load("VIEW","Footer");
		}
		
	public function listar_servicos_em_aberto_prop()
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
		
		$this->data["sorting"] = Array("column"=>0, "order"=>"desc");
		
		$this->load("VIEW","Header");
		
		$this->load("VIEW","ServicoManutencao_Proprietario");
		
		$this->load("VIEW","Footer");
		
	}
	
	public function listar_servicos_fechados_prop()
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
		
		$this->data["sorting"] = Array("column"=>0, "order"=>"desc");
		
		$this->load("VIEW","Header");
		
		$this->load("VIEW","ServicoManutencao_Proprietario");
		
		$this->load("VIEW","Footer");
		
	}
	
	public function detalhar_servico_prop()
	{	
		$this->load("VIEW","Header");
		
		$lista = $this->get_model_list("ServicoManutencaoModel", "nome asc");
		
		if(is_array($lista) && count($lista)==1)
		{

			$this->load("MODEL", "EventoModel");
			$this->load("MODEL", "OrcamentoModel");
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
					
					$this->data["historico_eventos"]["eventos"][$key]->setOrcamentos(DaoEntity::getAssociatedObjectArray($evento,new OrcamentoModel()));
				}
			}

			$this->load("VIEW","ServicoManutencao_Proprietario_Detail");
	
		}
		
		$this->load("VIEW","Footer");
	}
	
	public function listar_imovel_proprietario()
	{
		$this->load("MODEL", "UsuarioModel");
		$this->load("MODEL","ImovelModel");
		$this->load("MODEL", "ServicoManutencaoModel");
		
		$usuario = new UsuarioModel(Array("id"=>$this->session->getParam("SESSIONKEY")));
		$listImovel = DaoEntity::getAssociatedObjectArray($usuario, new ImovelModel(),"nome asc");
	
		$this->data["lista"] = $listImovel;
		
		$this->load("VIEW","Header");
		$this->load("VIEW","Imovel_List_Proprietario");
		$this->load("VIEW","Footer");
	}
	
	public function detalhar_imovel_proprietario()
	{
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
				if($usuario->getPerfil()==ServicoHelper::PROPRIETARIO)
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
						
			$this->load("VIEW","Imovel_Detail_Proprietario");
		}
		else
		{
			echo $this->helper->alertBox("Imóvel não encontrado.");
		}
	
		$this->load("VIEW","Footer");
	}
	
	public function servico_manutencao_analisar()
	{
		$this->load("MODEL","ServicoManutencaoModel");
		$this->load("MODEL","OrcamentoModel");
	
		$serv = new ServicoManutencaoModel($this->request_array);
		$lista = DaoEntity::getObjectArray($serv);
	
		$this->load("VIEW","Header");
	
		if(is_array($lista))
		{
			$this->data["model"] = $lista[0];
			$servico = $lista[0];
			if($servico->getSituacao()!=EnumHelper::APROVACAO)
			{
				echo $this->helper->alertBox("Este Serviço não pode ser enviado para orçamento!");
			}
			else
			{
				$this->data["model"]->setOrcamentos(DaoEntity::getAssociatedObjectArray($this->data["model"], new OrcamentoModel(Array("situacao"=>EnumHelper::ORCAMENTO_ABERTO))));
				$this->load("VIEW","ServicoManutencao_Proprietario_Analisar");
			}
				
		}
		else
		{
			echo $this->helper->alertBox("Serviço não encontrado.");
		}
	
		$this->load("VIEW","Footer");
	}
	
	public function servico_manutencao_analisar_salvar()
	{
		if($this->request_array["id"]!=null && $this->request_array["id"]!="")
		{	
			$this->load("MODEL","ServicoManutencaoModel");
			$this->load("MODEL","EventoModel");
			$this->load("MODEL","UsuarioModel");
			$this->load("MODEL","OrcamentoModel");
		
			$servico = new ServicoManutencaoModel($this->request_array);
			$servico = DaoEntity::getObjectArray($servico)[0];
			if($servico->getSituacao()!=EnumHelper::APROVACAO)
			{
				return self::doGoBackAction($this->helper->alertBox("Este Serviço não pode ser aprovado!"));
			}
			
			$evento = new EventoModel();
			$evento->setDescricao($this->request_array["detalhes"]);
			$evento->setDataDeModificacao(Date("Y-m-d"));
			
			if($this->request_array["orcamento"]==-1)
			{
				$servico->setSituacao(EnumHelper::ORCAMENTO);
				$evento->setEstadoAnterior(EnumHelper::APROVACAO);
				$evento->setEstadoModificado(EnumHelper::ORCAMENTO);
				$orcamentos = DaoEntity::getAssociatedObjectArray($servico,new OrcamentoModel());
				foreach($orcamentos as $orc)
				{
					$orc->setSituacao(EnumHelper::ORCAMENTO_REPROVADO);
					DaoEntity::updateObject($orc);
				}
				$evento->setValor(0);
				
				$evento = DaoEntity::insertObject($evento);
			}
			else
			{
				$servico->setSituacao(EnumHelper::ANDAMENTO);
				$evento->setEstadoAnterior(EnumHelper::APROVACAO);
				$evento->setEstadoModificado(EnumHelper::ANDAMENTO);
				$orcamentos = DaoEntity::getAssociatedObjectArray($servico, new OrcamentoModel());
				foreach($orcamentos as $orc)
				{
					if($orc->getId()==$this->request_array["orcamento"])
					{
						$orc->setSituacao(EnumHelper::ORCAMENTO_APROVADO);
						$evento->setValor($orc->getValor());
					}
					else
						$orc->setSituacao(EnumHelper::ORCAMENTO_REPROVADO);
					
					DaoEntity::updateObject($orc);
				}
				
				$evento = DaoEntity::insertObject($evento);
				
			}
			
			$servico = DaoEntity::updateObject($servico);
			
			$usuario = new UsuarioModel();
			$usuario->setId($this->session->getParam("SESSIONKEY"));
			
			DaoEntity::associateObjects($servico, $evento);
			DaoEntity::associateObjects($evento, $usuario);
		}
		
		$this->redirect("Proprietario","listar_servicos_em_aberto_prop");
	}
		
}