<div id="app-window-1">	
	<h1>Enviar Serviço de Manutenção para Aprovação do Proprietário</h1>
	<div id="app-panel-detail-panel">
	
<?php
	$model = $this->data["model"];

	echo $this->helper->open_form("edit","index.php");
	echo $this->helper->hidden("module","Gerencia");
	echo $this->helper->hidden("action","servico_manutencao_aprovacao_salvar");
	echo $this->helper->hidden("idServicoManutencao",$this->request_array["id"]);
		
	echo "<p>Título: ".$model->getNome()."</p>";
	echo "<p>Descrição: ".$model->getDescricao()."</p>";
	echo "<hr/>";
	echo "<p>Detalhes: ".$this->helper->textarea("detalheEvento")."</p>";
	echo "<hr/><h3>Orçamento 1</h3>";
	echo "<p>PDF: ".$this->helper->input("orcamento1_pdf","file")."</p>";
	echo "<p>Valor (R$): ".$this->helper->input("orcamento1_valor","text")."</p>";
	echo "<hr/><h3>Orçamento 2</h3>";
	echo "<p>PDF: ".$this->helper->input("orcamento2_pdf","file")."</p>";
	echo "<p>Valor (R$): ".$this->helper->input("orcamento2_valor","text")."</p>";
	echo "<hr/><h3>Orçamento 3</h3>";
	echo "<p>PDF: ".$this->helper->input("orcamento3_pdf","file")."</p>";
	echo "<p>Valor (R$): ".$this->helper->input("orcamento3_valor","text")."</p>";
	echo "<hr/>";
	echo "<p>".$this->helper->submit("Enviar")."</p>";
	
	$this->helper->close_form();
?>
	</div>
</div>