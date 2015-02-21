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
	echo "<p>Título: ".$model->getNome()."</p>";
	echo "<table><tr><td>Descrição:</td><td>".$model->getDescricao()."</td></tr></table>";
	echo "<p>Situação: ".EnumHelper::getSituacoes()[$model->getSituacao()]."</p>";
	if($model->getSituacao()==EnumHelper::ANDAMENTO)
	{
		echo "<p>".$this->helper->link("#","Concluir Serviço","if(window.confirm('Deseja realmente concluir este serviço?')) window.location = '?module=Inquilino&action=servico_manutencao_concluir&id=".$model->getId()."' ;")."</p>";
	}
	
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
			echo "<p>Descrição: ".$evento->getDescricao()."</p>";
			echo "<br/>";
		}
		
	}
	
	echo "<hr/>";
	echo "<p>".$this->helper->link("?module=Inquilino&action=listar_servicos_em_aberto","Voltar")."</p>";
?>
	</div>
</div>

