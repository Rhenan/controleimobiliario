
<div id="app-window-1">	
	<h1>Enviar Serviço de Manutenção para Orçamento</h1>
	<div id="app-panel-detail-panel">

	<?php
	$model = $this->data["model"];

	echo $this->helper->open_form("edit","index.php");
	echo $this->helper->hidden("module","Gerencia");
	echo $this->helper->hidden("action","servico_manutencao_orcamento_salvar");
	echo $this->helper->hidden("idServicoManutencao",$this->request_array["id"]);
		
	echo "<p>Título: ".$model->getNome()."</p>";
	echo "<p>Descrição: ".$model->getDescricao()."</p>";
	echo "<hr/>";
	echo "<p>Detalhes: ".$this->helper->textarea("detalheEvento")."</p>";
	echo "<hr/>";
	echo "<p>".$this->helper->submit("Enviar")."</p>";
	
	$this->helper->close_form();
?>
	</div>
</div>