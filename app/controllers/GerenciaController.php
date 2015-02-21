<?php
class GerenciaController extends AccessController {
	public function __construct()
	{
		parent::__construct();
		
		$this->data["page_title"] = "Gerência";
		
	}
	
	public function dashboard_Gerencia()
	{
		$this->load("MODEL","ServicoManutencaoModel");
		
		$manutencao = new ServicoManutencaoModel();
		$manutencao->setSituacao(EnumHelper::NOVO);
		
		$this->data["manutencoes_novas"] = DaoEntity::getObjectArray($manutencao,"id desc");
		
		$manutencao->setSituacao(EnumHelper::AGUARDANDO);
		$this->data["manutencoes_aguardando"] = DaoEntity::getObjectArray($manutencao,"id desc");
	
		$manutencao->setSituacao(EnumHelper::ORCAMENTO);
		$this->data["manutencoes_orcamento"] = DaoEntity::getObjectArray($manutencao,"id desc");
	
		
		$this->load("HELPER", "EstatisticasHelper");
		$this->data["estatisticas"] = EstatisticasHelper::getEstatisticaManutencoes();
		
		
		$this->load("VIEW","Header");
		$this->load("VIEW","Dashboard_Gerencia");
		$this->load("VIEW","Footer");
	}
	
	/* TipoManutencao */
	public function listar_tipo_manutencao()
	{
		$lista = $this->get_model_list("TipoManutencaoModel", "nome asc");
		
		$this->data["lista"] = $lista;
		$this->data["sorting"] = Array("column"=>1, "order"=>"asc");
		
		$this->data["page_title"] = "Gerência";
		$this->load("VIEW","Header");
		$this->load("VIEW","TipoManutencao_List");
		$this->load("VIEW","Footer");
	}
	
	public function detalhar_tipo_manutencao()
	{
		$this->data["page_title"] = "Gerência";
		$this->load("VIEW","Header");
		
		$lista = $this->get_model_list("TipoManutencaoModel", "nome asc");
	
		if(is_array($lista) && count($lista)==1)
		{
			$this->data["model"] = $lista[0];
			$this->load("VIEW","TipoManutencao_Detail");
		}
		
		$this->load("VIEW","Footer");
	}
	
	public function editar_tipo_manutencao()
	{
		$this->load("MODEL","TipoManutencaoModel");
		
		$this->data["page_title"] = "Gerência";
		$this->load("VIEW","Header");
		
		$lista = null;
		if(array_key_exists("id",$this->request_array) && ($this->request_array["id"]!=null || $this->request_array["id"]!=""))
			$lista = $this->get_model_list("TipoManutencaoModel", "nome asc");
	
		if(is_array($lista) && count($lista)==1)
		{
			$this->data["model"] = $lista[0];
			$this->load("VIEW","TipoManutencao_Edit");
		}
		else
		{
			$this->data["model"] = new TipoManutencaoModel();
			$this->load("VIEW","TipoManutencao_Edit");
		}
		
		$this->load("VIEW","Footer");
	}
	
	public function salvar_tipo_manutencao()
	{
		if(!array_key_exists("id",$this->request_array) || ($this->request_array["id"]==null || $this->request_array["id"]==""))
			$this->insert_model("TipoManutencaoModel");
		else
			$this->update_model("TipoManutencaoModel");
		
		$this->redirect("Gerencia","listar_tipo_manutencao");
	}
	
	public function excluir_tipo_manutencao()
	{
		if(array_key_exists("id",$this->request_array) && ($this->request_array["id"]!=null || $this->request_array["id"]!=""))
			$this->delete_model("TipoManutencaoModel");
	
		$this->redirect("Gerencia","listar_tipo_manutencao");
	}
	
	
	/* ServicoManutencao */
	public function listar_servico_manutencao()
	{
		$lista = $this->get_model_list("ServicoManutencaoModel", "nome asc");
		
		$this->data["lista"] = $lista;
		
		$this->data["sorting"] = Array("column"=>0, "order"=>"desc");
		
		$this->data["page_title"] = "Gerência";
		$this->load("VIEW","Header");
		$this->load("VIEW","ServicoManutencao_List");
		$this->load("VIEW","Footer");
	}
	
	public function detalhar_servico_manutencao()
	{
		$this->data["page_title"] = "Gerência";
		
		$this->load("VIEW","Header");
	
		$lista = $this->get_model_list("ServicoManutencaoModel", "nome asc");
	
		if(is_array($lista) && count($lista)==1)
		{
			$this->load("MODEL", "EventoModel");
			$this->load("MODEL", "OrcamentoModel");
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
			
			$this->load("VIEW","ServicoManutencao_Detail");
		}
	
		$this->load("VIEW","Footer");
	}
	
	public function salvar_servico_manutencao()
	{
		$this->load("MODEL","ServicoManutencaoModel");
		$this->load("MODEL","TipoManutencaoModel");
		
		$temp_request_array = $this->request_array;
				
		if(!array_key_exists("id",$this->request_array) || ($this->request_array["id"]==null || $this->request_array["id"]==""))
		{
			$this->insert_model("ServicoManutencaoModel");
			$tipo = new TipoManutencaoModel();
			$tipo->setId($temp_request_array["tipo"]);
			
			$model = DaoEntity::getObjectArray(new ServicoManutencaoModel($temp_request_array))[0];
			
			DaoEntity::associateObjects($model, $tipo);
		}
		else
			$this->update_model("ServicoManutencaoModel");
		
		
		
		
		$this->redirect("Gerencia","listar_servico_manutencao");
	}
	
	
	/* Imovel */
	public function listar_imovel()
	{
	
		$lista = $this->get_model_list("ImovelModel", "nome asc");
	
		$this->data["lista"] = $lista;
	
		$this->data["page_title"] = "Gerência";
		$this->load("VIEW","Header");
		$this->load("VIEW","Imovel_List");
		$this->load("VIEW","Footer");
	}
	
	public function detalhar_imovel()
	{
		$this->data["page_title"] = "Gerência";
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
					$inqList[$usuario->getId()] = $usuario;
				else if($usuario->getPerfil()==ServicoHelper::PROPRIETARIO)
					$propList[$usuario->getId()] = $usuario;
			}
			
			$this->data["inquilinos_list"] = $inqList;
			$this->data["proprietarios_list"] = $propList;
						
			$this->load("VIEW","Imovel_Detail");
		}
	
		$this->load("VIEW","Footer");
	}
	
	public function editar_imovel()
	{
		$this->load("MODEL","ImovelModel");
	
		$this->data["page_title"] = "Gerência";
		$this->load("VIEW","Header");
	
		$lista = null;
		if(array_key_exists("id",$this->request_array) && ($this->request_array["id"]!=null || $this->request_array["id"]!=""))
			$lista = $this->get_model_list("ImovelModel", "nome asc");
	
		if(is_array($lista) && count($lista)==1)
		{
			$this->data["model"] = $lista[0];
			$this->load("VIEW","Imovel_Edit");
		}
		else
		{
			$this->data["model"] = new ImovelModel();
			$this->load("VIEW","Imovel_Edit");
		}
	
		$this->load("VIEW","Footer");
	}
	
	public function salvar_imovel()
	{
		if(!array_key_exists("id",$this->request_array) || ($this->request_array["id"]==null || $this->request_array["id"]==""))
			$this->insert_model("ImovelModel");
		else
			$this->update_model("ImovelModel");
	
		$this->redirect("Gerencia","listar_imovel");
	}
	
	public function excluir_imovel()
	{
		if(array_key_exists("id",$this->request_array) && ($this->request_array["id"]!=null || $this->request_array["id"]!=""))
		{
			$this->load("MODEL", "ImovelModel");
			$this->load("MODEL", "ServicoManutencaoModel");
			$this->load("MODEL", "TipoManutencaoModel");
			$this->load("MODEL", "EventoModel");
			$this->load("MODEL", "OrcamentoModel");
			$this->load("MODEL", "UsuarioModel");
			
			$imovel = new ImovelModel($this->request_array);
			
			$manutencoes = DaoEntity::getAssociatedObjectArray($imovel, new ServicoManutencaoModel());
			
			DaoEntity::disassociateAll($imovel, new ServicoManutencaoModel());
			if($manutencoes!=null && is_array($manutencoes) && !empty($manutencoes))
			{
				foreach($manutencoes as $man)
				{
					DaoEntity::disassociateAll($man, new OrcamentoModel());
					DaoEntity::disassociateAll($man, new TipoManutencaoModel());
					
					$eventos = DaoEntity::getAssociatedObjectArray($man, new EventoModel());
					DaoEntity::disassociateAll($man, new EventoModel());
					
					if($eventos!=null && is_array($eventos) && !empty($eventos))
					{
						foreach($eventos as $evt)
						{
							$orcamentos = DaoEntity::getAssociatedObjectArray($evt, new OrcamentoModel());
							
							DaoEntity::disassociateAll($evt, new OrcamentoModel());
							DaoEntity::disassociateAll($evt, new UsuarioModel());
							
							if($orcamentos!=null && is_array($orcamentos) && !empty($orcamentos))
							{
								foreach($orcamentos as $orc)
								{
									File::remove_file($orc->getPdf());
									DaoEntity::removeObject($orc);
								}
							}
							DaoEntity::removeObject($evt);
						}
					}
					
					DaoEntity::disassociateAll($man, new UsuarioModel());
					DaoEntity::removeObject($man);
				}
			}
			
			DaoEntity::disassociateAll($imovel, new UsuarioModel());
			
			$this->delete_model("ImovelModel");
		}
		
		$this->redirect("Gerencia","listar_imovel");
	}
	
	public function imovel_associar_inquilino_editar()
	{
		$imovel = null;
		if(array_key_exists("id",$this->request_array) && ($this->request_array["id"]!=null || $this->request_array["id"]!=""))
			$imovel = $this->get_model_list("ImovelModel", "nome asc");
		else
		{
			echo $this->helper->alertBox("Imóvel Inválido");
			return;
		}
		
		if(!is_array($imovel) || !count($imovel)==1)
		{
			echo $this->helper->alertBox("Imóvel Inválido");
			return;
		}
		else
		{
			$imovel = $imovel[0];
			$this->data["idImovel"] = $imovel->getId();
		}
		
		$this->load("MODEL", "UsuarioModel");
		$usuarioInquilino = new UsuarioModel(Array("perfil"=>ServicoHelper::INQUILINO),"nome asc");
		$inquilinosList = DaoEntity::getObjectArray($usuarioInquilino);

		$list = Array();
		if(is_array($inquilinosList)) foreach($inquilinosList as $inq)
		{
			$list[$inq->getId()] = $inq->getUsuario()." - ".$inq->getNome();
		}
		
		$this->data["list"] =  $list;
		
		$this->data["page_title"] = "Gerência";
		$this->load("VIEW","Header");
		$this->load("VIEW","Imovel_Associar_Inquilino");
		$this->load("VIEW","Footer");
	}
	
	public function imovel_associar_inquilino_salvar()
	{
		if(array_key_exists("idImovel", $this->request_array) && array_key_exists("idUsuario", $this->request_array))
		{
			$this->load("MODEL", "UsuarioModel");
			$this->load("MODEL","ImovelModel");
			
			$imovel = new ImovelModel(Array("id"=>$this->request_array["idImovel"]));
			$usuario = new UsuarioModel(Array("id"=>$this->request_array["idUsuario"]));
			
			
			$relation = DaoEntity::getAssociatedObjectArray($usuario, $imovel);
			if(is_array($relation) && !empty($relation))
				DaoEntity::disassociateObjects($usuario, $imovel);
			
			DaoEntity::associateObjects($usuario, $imovel);
			
			$this->request_array["action"] = "detalhar_imovel";
			$this->redirectRequest($this->request_array);
		}
	}
	
	public function imovel_associar_proprietario_editar()
	{
		$imovel = null;
		if(array_key_exists("id",$this->request_array) && ($this->request_array["id"]!=null || $this->request_array["id"]!=""))
			$imovel = $this->get_model_list("ImovelModel", "nome asc");
		else
		{
			echo $this->helper->alertBox("Imóvel Inválido");
			return;
		}
	
		if(!is_array($imovel) || !count($imovel)==1)
		{
			echo $this->helper->alertBox("Imóvel Inválido");
			return;
		}
		else
		{
			$imovel = $imovel[0];
			$this->data["idImovel"] = $imovel->getId();
		}
	
		$this->load("MODEL", "UsuarioModel");
		$usuarioProp = new UsuarioModel(Array("perfil"=>ServicoHelper::PROPRIETARIO),"nome asc");
		$propList = DaoEntity::getObjectArray($usuarioProp);
	
		$list = Array();
		if(is_array($propList)) foreach($propList as $prop)
		{
			$list[$prop->getId()] = $prop->getUsuario()." - ".$prop->getNome();
		}
	
		$this->data["list"] =  $list;
	
		$this->data["page_title"] = "Gerência";
		$this->load("VIEW","Header");
		$this->load("VIEW","Imovel_Associar_Proprietario");
		$this->load("VIEW","Footer");
	}
	
	public function imovel_associar_proprietario_salvar()
	{
		if(array_key_exists("idImovel", $this->request_array) && array_key_exists("idUsuario", $this->request_array))
		{
			$this->load("MODEL", "UsuarioModel");
			$this->load("MODEL","ImovelModel");
				
			$imovel = new ImovelModel(Array("id"=>$this->request_array["idImovel"]));
			$usuario = new UsuarioModel(Array("id"=>$this->request_array["idUsuario"]));
				
			$relation = DaoEntity::getAssociatedObjectArray($usuario, $imovel);
			if(is_array($relation) && !empty($relation))
				DaoEntity::disassociateObjects($usuario, $imovel);
			
			DaoEntity::associateObjects($usuario, $imovel);
			
			$this->request_array["action"] = "detalhar_imovel";
			$this->redirectRequest($this->request_array);
		}
	}
	
	public function imovel_desassociar_usuario()
	{
		if(array_key_exists("idImovel", $this->request_array) && array_key_exists("idUsuario", $this->request_array))
		{
			$this->load("MODEL", "UsuarioModel");
			$this->load("MODEL","ImovelModel");
	
			$imovel = new ImovelModel(Array("id"=>$this->request_array["idImovel"]));
			$usuario = new UsuarioModel(Array("id"=>$this->request_array["idUsuario"]));
	
			DaoEntity::disassociateObjects($usuario, $imovel);
	
			$this->redirect("Gerencia","listar_imovel");
		}
	}

	public function servico_manutencao_orcamento()
	{
		$this->load("MODEL","ServicoManutencaoModel");
		
		$serv = new ServicoManutencaoModel($this->request_array);
		$lista = DaoEntity::getObjectArray($serv);

		$this->data["page_title"] = "Gerência";
		$this->load("VIEW","Header");
		
		if(is_array($lista))
		{
			$this->data["model"] = $lista[0];
			$servico = $lista[0];
			if($servico->getSituacao()!="AGUARDANDO")
			{
				echo $this->helper->alertBox("Este Serviço não pode ser enviado para orçamento!");
			}
			else
				$this->load("VIEW","ServicoManutencao_Orcamento");
		}
		else
		{
			echo $this->helper->alertBox("Serviço não encontrado.");
		}
		
		$this->load("VIEW","Footer");
	}
	
	public function servico_manutencao_orcamento_salvar()
	{
		if($this->request_array["idServicoManutencao"]!=null && $this->request_array["idServicoManutencao"]!="")
		{	
			$this->load("MODEL","ServicoManutencaoModel");
			$this->load("MODEL","EventoModel");
			$this->load("MODEL","UsuarioModel");
		
			$servico = new ServicoManutencaoModel(Array("id"=>$this->request_array["idServicoManutencao"]));
			$servico = DaoEntity::getObjectArray($servico)[0];
			if($servico->getSituacao()!="AGUARDANDO")
			{
				echo $this->helper->alertBox("Este Serviço não pode ser enviado para orçamento!");
				return;
			}
			
			$evento = new EventoModel();
			$evento->setDescricao(nl2br($this->request_array["detalheEvento"]));
			$evento->setDataDeModificacao(Date("Y-m-d"));
			$evento->setEstadoAnterior("AGUARDANDO");
			$evento->setEstadoModificado("ORCAMENTO");
			$evento->setValor(0);

			$evento = DaoEntity::insertObject($evento);
			
			$usuario = new UsuarioModel();
			$usuario->setId($this->session->getParam("SESSIONKEY"));
			
			DaoEntity::associateObjects($servico, $evento);
			DaoEntity::associateObjects($evento, $usuario);
			
			$servico->setSituacao("ORCAMENTO");
			
			$servico = DaoEntity::updateObject($servico);
		}
		
		$this->redirect("Gerencia","listar_servico_manutencao");
	}
	
	public function servico_manutencao_aprovacao()
	{
		$this->load("MODEL","ServicoManutencaoModel");
		
		$serv = new ServicoManutencaoModel($this->request_array);
		$lista = DaoEntity::getObjectArray($serv);

		$this->data["page_title"] = "Gerência";
		$this->load("VIEW","Header");
		
		if(is_array($lista))
		{
			$this->data["model"] = $lista[0];
			$servico = $lista[0];
			if($servico->getSituacao()!="ORCAMENTO")
			{
				return self::doGoBackAction($this->helper->alertBox("Este Serviço não pode ser enviado para aprovação!"));
			}
			else
				$this->load("VIEW","ServicoManutencao_Aprovacao");
		}
		else
		{
			return self::doGoBackAction($this->helper->alertBox("Serviço não encontrado."));
		}
		
		$this->load("VIEW","Footer");
	}
	
	public function servico_manutencao_aprovacao_salvar()
	{
		if($this->request_array["idServicoManutencao"]!=null && $this->request_array["idServicoManutencao"]!="")
		{	
			$this->load("MODEL","ServicoManutencaoModel");
			$this->load("MODEL","EventoModel");
			$this->load("MODEL","OrcamentoModel");
			$this->load("MODEL","UsuarioModel");
		
			$servico = new ServicoManutencaoModel(Array("id"=>$this->request_array["idServicoManutencao"]));
			$servico = DaoEntity::getObjectArray($servico)[0];
			if($servico->getSituacao()!="ORCAMENTO")
			{
				return self::doGoBackAction($this->helper->alertBox("Este Serviço não pode ser enviado para aprovação!"));
				
			}
			
			$evento = new EventoModel();
			$evento->setDescricao(nl2br($this->request_array["detalheEvento"]));
			$evento->setDataDeModificacao(Date("Y-m-d"));
			$evento->setEstadoAnterior("ORCAMENTO");
			$evento->setEstadoModificado("APROVACAO");
			
			
			if(!array_key_exists("orcamento1_pdf",$_FILES) || empty($_FILES["orcamento1_pdf"]["type"]) || !is_numeric($this->request_array["orcamento1_valor"]))
			{
				return self::doGoBackAction($this->helper->alertBox("Você deve adicionar pelo menos um orçamento com valor e documento pdf."));
			}
			
			try{
				$orcamentoPdf1 = new File($_FILES["orcamento1_pdf"],File::PDF);
			}
			catch(Exception $e)
			{
				return self::doGoBackAction($this->helper->alertBox("Formato de arquivo inválido!."));
			}
			
			$orcamento1 = new OrcamentoModel();
			$orcamento1->setTitulo("Orçamento 1");
			$orcamento1->setValor($this->request_array["orcamento1_valor"]);
			$orcamento1->setPdf($orcamentoPdf1->upload(true));
			$orcamento1->setSituacao(EnumHelper::ORCAMENTO_ABERTO);
			
			$orcamento1 = DaoEntity::insertObject($orcamento1);
			
			$orcamento2 = null;
			if(array_key_exists("orcamento2_pdf",$_FILES) && !empty($_FILES["orcamento2_pdf"]["type"]) && is_numeric($this->request_array["orcamento2_valor"]))
			{
				try{
					$orcamentoPdf2 = new File($_FILES["orcamento2_pdf"],File::PDF);
				}
				catch(Exception $e)
				{
					return self::doGoBackAction($this->helper->alertBox("Formato de arquivo inválido!."));
				}
				
				$orcamento2 = new OrcamentoModel();
				$orcamento2->setTitulo("Orçamento 2");
				$orcamento2->setValor($this->request_array["orcamento2_valor"]);
				$orcamento2->setPdf($orcamentoPdf2->upload(true));
				$orcamento2->setSituacao(EnumHelper::ORCAMENTO_ABERTO);
				
				$orcamento2 = DaoEntity::insertObject($orcamento2);
			}
			
			$orcamento3 = null;
			if(array_key_exists("orcamento3_pdf",$_FILES) && !empty($_FILES["orcamento3_pdf"]["type"]) && is_numeric($this->request_array["orcamento3_valor"]))
			{
				try{
					$orcamentoPdf3 = new File($_FILES["orcamento3_pdf"],File::PDF);
				}
				catch(Exception $e)
				{
					return self::doGoBackAction($this->helper->alertBox("Formato de arquivo inválido!."));
				}
				
				$orcamento3 = new OrcamentoModel();
				$orcamento3->setTitulo("Orçamento 3");
				$orcamento3->setValor($this->request_array["orcamento3_valor"]);
				$orcamento3->setPdf($orcamentoPdf3->upload(true));
				$orcamento3->setSituacao(EnumHelper::ORCAMENTO_ABERTO);
				
				$orcamento3 = DaoEntity::insertObject($orcamento3);
			}
			
			$evento = DaoEntity::insertObject($evento);
			
			DaoEntity::associateObjects($evento, $orcamento1);
			DaoEntity::associateObjects($servico, $orcamento1);
			if($orcamento2!=null)
			{
				DaoEntity::associateObjects($servico, $orcamento2);
				DaoEntity::associateObjects($evento, $orcamento2);
			}
			if($orcamento3!=null)
			{
				DaoEntity::associateObjects($servico, $orcamento3);
				DaoEntity::associateObjects($evento, $orcamento3);
			}
			
			$usuario = new UsuarioModel();
			$usuario->setId($this->session->getParam("SESSIONKEY"));
			
			DaoEntity::associateObjects($servico, $evento);
			DaoEntity::associateObjects($evento, $usuario);

			$servico->setSituacao("APROVACAO");
			
			DaoEntity::updateObject($servico);
			$servico = DaoEntity::getObjectArray($servico)[0];
		}
		
		$this->request_array["action"] = "detalhar_servico_manutencao";
		$this->redirectRequest($this->request_array);
		
	}
	
	public function servico_manutencao_reprovar()
	{
		if($this->request_array["id"]!=null && $this->request_array["id"]!="")
		{	
			$this->load("MODEL","ServicoManutencaoModel");
			$this->load("MODEL","EventoModel");
			$this->load("MODEL","UsuarioModel");
		
			$servico = new ServicoManutencaoModel($this->request_array);
			$servico = DaoEntity::getObjectArray($servico)[0];
			if($servico->getSituacao()!="AGUARDANDO")
			{
				return self::doGoBackAction($this->helper->alertBox("Este Serviço não pode ser enviado para aprovação!"));
			}
			$servico->setSituacao("REPROVADO");
			
			$servico = DaoEntity::updateObject($servico);
						
			$evento = new EventoModel();
			$evento->setDescricao("O Serviço foi reprovado pela Imobiliária.");
			$evento->setDataDeModificacao(Date("Y-m-d"));
			$evento->setEstadoAnterior("AGUARDANDO");
			$evento->setEstadoModificado("REPROVADO");
			$evento->setValor(0);

			$evento = DaoEntity::insertObject($evento);
			
			$usuario = new UsuarioModel();
			$usuario->setId($this->session->getParam("SESSIONKEY"));
			
			DaoEntity::associateObjects($servico, $evento);
			DaoEntity::associateObjects($evento, $usuario);

		}
		
		$this->redirect("Gerencia","listar_servico_manutencao");
	}
	
	protected function doGoBackAction($alertMsg, $module="Gerencia")
	{
		parent::doGoBackAction($alertMsg,$module);
	}
}

?>
