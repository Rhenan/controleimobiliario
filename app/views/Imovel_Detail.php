<?php
	$data = $this->data;
	if(!isset($data["model"])&&!is_object($data["model"]))
	{
		echo "<h2>Imovel n�o encontrado(a).</h2>";
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
	
	echo "<hr/>";
	
	if(sizeof($this->data["inquilinos_list"]>0))
	{
		echo "<h3>Inquilino(s) no Imóvel</h3>";
		foreach($this->data["inquilinos_list"] as $inq)
		{
			echo "<p>".$inq->getNome()." / ".$inq->getUsuario()." - ";
			echo $this->helper->link("#","Excluir","if(window.confirm('Deseja realmente disassociar este inquilino?')) window.location = '?id=".$model->getId()."&module=Gerencia&action=imovel_desassociar_usuario&idImovel=".$model->getId()."&idUsuario=".$inq->getId()."';");
			echo "</p>";
		}
	}
	echo "<p>".$this->helper->link("?id=".$model->getId()."&module=Gerencia&action=imovel_associar_inquilino_editar","Associar Inquilino")."</p>";
	
	echo "<hr/>";
	
	if(sizeof($this->data["proprietarios_list"]>0))
	{
		echo "<h3>Proprietário(s) do Imóvel</h3>";
		foreach($this->data["proprietarios_list"] as $prop)
		{
			echo "<p>".$prop->getNome()." / ".$prop->getUsuario()." - ";
			echo $this->helper->link("#","Excluir","if(window.confirm('Deseja realmente disassociar este proprietário?')) window.location = '?id=".$model->getId()."&module=Gerencia&action=imovel_desassociar_usuario&idImovel=".$model->getId()."&idUsuario=".$prop->getId()."';");
			echo "</p>";
		}				
	}
	echo "<p>".$this->helper->link("?id=".$model->getId()."&module=Gerencia&action=imovel_associar_proprietario_editar","Associar Proprietário")."</p>";
	
	echo "<hr/>";
	
	echo "<p>".$this->helper->link("?id=".$model->getId()."&module=Gerencia&action=editar_imovel","Editar")."</p>";
	echo "<p>".$this->helper->link("?module=Gerencia&action=listar_imovel","Voltar")."</p>";
	
?>
	</div>
</div>
