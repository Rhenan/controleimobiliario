<?php
	$data = $this->data;
	if(!isset($data["model"])&&!is_object($data["model"]))
	{
		echo "<h2>Imóvel não encontrado(a).</h2>";
		return;
	}
	
	$model = $data["model"];
?>
<div id="app-window-1">	
	<h1>Editar Imóvel</h1>
	<div id="app-panel-detail-panel">
<?php
	echo $this->helper->open_form("edit","index.php");
	echo $this->helper->hidden("module","Gerencia");
	echo $this->helper->hidden("action","salvar_imovel");
	echo $this->helper->hidden("id",$model->getId());
	
	echo "<p>nome: ".$this->helper->input("nome","text",$model->getNome())."</p>";
	echo "<p>identificador: ".$this->helper->input("identificador","text",$model->getIdentificador())."</p>";
	echo "<p>endereco: ".$this->helper->input("endereco","text",$model->getEndereco())."</p>";
	echo "<p>cep: ".$this->helper->input("cep","text",$model->getCep())."</p>";

	echo "<p>".$this->helper->submit("Enviar")."</p>";
		
	$this->helper->close_form();
?>
	</div>
</div>
