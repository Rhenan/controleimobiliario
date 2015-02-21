<div id="app-window-1">	
	<h1>Associar Imovel a um Inquilino</h1>
	<div id="app-panel-detail-panel">
<?php
	echo $this->helper->open_form("edit","index.php");
	echo $this->helper->hidden("module","Gerencia");
	echo $this->helper->hidden("action","imovel_associar_inquilino_salvar");
	echo $this->helper->hidden("idImovel",$this->data["idImovel"]);

	echo "<p>Inquilinos: ".$this->helper->combo("idUsuario",$this->data["list"],null,TRUE)."</p>";

	echo "<p>".$this->helper->submit("Enviar")."</p>";
		
	$this->helper->close_form();
?>
	</div>
</div>
