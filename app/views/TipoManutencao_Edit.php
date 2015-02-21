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
	<h1>Editar TipoManutencao</h1>
	<div id="app-panel-detail-panel">

<?php
	echo $this->helper->open_form("edit","index.php");
	echo $this->helper->hidden("module","Gerencia");
	echo $this->helper->hidden("action","salvar_tipo_manutencao");
	echo $this->helper->hidden("id",$model->getId());
	
	echo "<p>Nome: ".$this->helper->input("nome","text",$model->getNome())."</p>";
	echo "<p>Categoria: ".$this->helper->combo("categoria",EnumHelper::getCategoriasDeManutencao(),$model->getCategoria())."</p>";

	echo "<p>".$this->helper->submit("Enviar")."</p>";
		
	$this->helper->close_form();
?>
	</div>
</div>
