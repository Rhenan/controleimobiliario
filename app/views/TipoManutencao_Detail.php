<?php
	$data = $this->data;
	if(!isset($data["model"])&&!is_object($data["model"]))
	{
		echo "<h2>TipoManutencao n�o encontrado(a).</h2>";
		return;
	}
	
	$model = $data["model"];
?>

<div id="app-window-1">	
	<h1>Detalhar TipoManutencao</h1>
	<div id="app-panel-detail-panel">

<?php
	$this->helper->open_form("edit","index.php");
	$this->helper->hidden("module","");
	$this->helper->hidden("action","");

	echo "<p>id: ".$model->getId()."</p>";
	echo "<p>nome: ".$model->getNome()."</p>";
	echo "<p>categoria: ".$model->getCategoria()."</p>";
	echo "<br/>";
	echo "<p>".$this->helper->link("?id=".$model->getId()."&module=Gerencia&action=editar_tipo_manutencao","Editar")."</p>";
	echo "<p>".$this->helper->link("?module=Gerencia&action=listar_tipo_manutencao","Voltar")."</p>";
	
	$this->helper->close_form();
?>
	</div>
</div>
