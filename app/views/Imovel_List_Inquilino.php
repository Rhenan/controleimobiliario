<div id="app-window-1">	
	<h1>Lista de Imóveis</h1>
	<div id="app-panel-detail-panel">
	<?php	
		echo "<table class='tbl'>";
		
		echo "<thead><tr>";
		echo "<th>ID</th>";
		echo "<th>Nome</th>";
		echo "<th>Identificador</th>";
		echo "<th>Endereço</th>";
		echo "<th>CEP</th>";
		echo "<th>Detalhar</th>";
		echo "</tr></thead>";
		
		echo"<tbody>";
		if(is_array($this->data["lista"])) foreach($this->data["lista"] as $model)
		{
			echo "<tr>";
			echo "<td>".$model->getId()."</td>";
			echo "<td>".$model->getNome()."</td>";
			echo "<td>".$model->getIdentificador()."</td>";
			echo "<td>".$model->getEndereco()."</td>";
			echo "<td>".$model->getCep()."</td>";
			echo "<td>".$this->helper->link("?id=".$model->getId()."&module=Inquilino&action=detalhar_imovel_inquilino","Detalhar")."</td>";
			echo "</tr>";
		}
		
		echo "</tbody>";
		echo "</table><br/>";
	?>
	</div>
</div>
