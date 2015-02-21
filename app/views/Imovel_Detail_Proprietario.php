<?php
	$data = $this->data;
	if(!isset($data["model"])&&!is_object($data["model"]))
	{
		echo "<h2>Imovel não encontrado(a).</h2>";
		return;
	}
	
	$model = $data["model"];
?>

<div id="app-window-1">	
	<h1>Detalhar Imóvel</h1>
	<div id="app-panel-detail-panel">
<?php

	echo "<p>id: ".$model->getId()."</p>";
	echo "<p>nome: ".$model->getNome()."</p>";
	echo "<p>identificador: ".$model->getIdentificador()."</p>";
	echo "<p>endereco: ".$model->getEndereco()."</p>";
	echo "<p>cep: ".$model->getCep()."</p>";
	
	
	if(!empty($this->data["inquilinos_list"]))
	{
		echo "<hr/>";
		
		echo "<h3>Inquilino(s) no Imóvel</h3>";
		foreach($this->data["inquilinos_list"] as $inq)
		{
			echo "<p>".$inq->getNome()."</p>";
		}
	}
	

	if(!empty($this->data["proprietarios_list"]))
	{
		echo "<hr/>";
		
		echo "<h3>Proprietário(s) do Imóvel</h3>";
		foreach($this->data["proprietarios_list"] as $prop)
		{
			echo "<p>".$prop->getNome()."</p>";
		}				
	}
	
	echo "<hr/>";
	
	echo "<p>".$this->helper->link("?module=Proprietario&action=listar_imovel_proprietario","Voltar")."</p>";
	
?>
	</div>
</div>
