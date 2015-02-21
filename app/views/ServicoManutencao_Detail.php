<?php
	$data = $this->data;
	if(!isset($data["model"])&&!is_object($data["model"]))
	{
		echo "<h2>ServicoManutencao não encontrado(a).</h2>";
		return;
	}
	
	$model = $data["model"];
?>

<div id="app-window-1">	
	<h1>Detalhar Serviço de Manutenção</h1>
	<div id="app-panel-detail-panel">

<?php
	echo "<p>ID: ".$model->getId()."</p>";
	echo "<p>Nome: ".$model->getNome()."</p>";
	echo "<table><tr><td>Descrição:</td><td>".$model->getDescricao()."</td></tr></table>";
	$situacao = $model->getSituacao();
	echo "<p>Situação: ".EnumHelper::getSituacoes()[$situacao]."</p>";
	if($situacao=="AGUARDANDO")
	{
		echo $this->helper->link("?id=".$model->getId()."&module=Gerencia&action=servico_manutencao_orcamento","Enviar para Manutenção");
		echo " <> ";
		echo $this->helper->link("#","Reprovar Serviço","if(window.confirm('Deseja realmente reprovar este serviço?')) window.location = '?id=".$model->getId()."&module=Gerencia&action=servico_manutencao_reprovar';");
	}
	else if($situacao=="ORCAMENTO")
		echo $this->helper->link("?id=".$model->getId()."&module=Gerencia&action=servico_manutencao_aprovacao","Enviar para Aprovação do Proprietário");
		
		
	if(!empty($this->data["historico_eventos"]))
	{
		echo "<hr/>";
		$situacoes = EnumHelper::getSituacoes();
		echo "<h3>Histórico de Mudanças</h3>";
		$valorTotal = 0;
		foreach($this->data["historico_eventos"]["eventos"] as $key=>$evento)
		{
			echo "<h4>Responsável: ".$this->data["historico_eventos"]["responsaveis"][$key]->getNome()."</h4>";
			echo "<p>Situação Anterior: ".$situacoes[$evento->getEstadoAnterior()]."</p>";
			echo "<p>Situação Modificada: ".$situacoes[$evento->getEstadoModificado()]."</p>";
			echo "<p>Data do Evento: ".$this->helper->dataMask($evento->getDataDeModificacao())."</p>";
			echo "<p>Descricao: ".$evento->getDescricao()."</p>";
			
			$orcamentos = $evento->getOrcamentos();
			if($orcamentos != null && !empty($orcamentos))
			{
				foreach($orcamentos as $orc)
				{
					echo "<br/><h4>".$orc->getTitulo()." - ".$this->helper->link("?module=File&action=download_orcamento&filepath=".$orc->getPdf()."","Baixar Detalhes")."</h4>";
					echo "<p>R$ ".$orc->getValor()."</p>";
				}
			}
			
			$valorTotal += ($evento->getValor()>0 ? $evento->getValor() : 0.0);			
		}
		
		echo "<hr/><p><b>Total da Manutenção: R$ ".$this->helper->moneyMask($valorTotal)."</b></p>";
	}
	
	echo "<hr/>";
	echo "<p>".$this->helper->link("?module=Gerencia&action=listar_servico_manutencao","Voltar")."</p>";
	
?>
	</div>
</div>
