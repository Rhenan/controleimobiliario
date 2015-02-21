<div id="app-window-1">	
	<h1>Enviar Serviço de Manutenção para Aprovação do Proprietário</h1>
	<div id="app-panel-detail-panel">
	
<?php
	$model = $this->data["model"];

	echo $this->helper->open_form("edit","index.php");
	echo $this->helper->hidden("module","Proprietario");
	echo $this->helper->hidden("action","servico_manutencao_analisar_salvar");
	echo $this->helper->hidden("id",$this->request_array["id"]);
		
	echo "<p>Título: ".$model->getNome()."</p>";
	echo "<p>Descrição: ".$model->getDescricao()."</p>";
	echo "<hr/>";

	echo "<p>Orçamento aprovado:</p>";
	foreach($model->getOrcamentos() as $orc)
	{
		echo "<p>".$this->helper->radio("orcamento",$orc->getTitulo()." - R$ ".$orc->getValor(),$orc->getId())."</p>";
	}
	echo "<p>".$this->helper->radio("orcamento","Nenhum orçamento me agradou.",-1,true)."</p>";
	
	echo "<br/><br/><table><tr><td>Detalhes:</td><td>".$this->helper->textarea("detalhes")."</td></tr></table>";
	
	echo "<br/><p>".$this->helper->submit("Enviar")."</p>";
	
	$this->helper->close_form();
?>
	</div>
</div>