<div id="app-window-1">	
	<h1>Lista de Imóveis</h1>
	<div id="app-panel-detail-panel">
		<?php	
			echo "<p>".$this->helper->link("?module=Gerencia&action=editar_imovel","Adicionar Imóvel")."</p>";
			
			echo "<table class='tbl'>";
			
			echo "<thead><tr>";
			echo "<th>ID</th>";
			echo "<th>Nome</th>";
			echo "<th>Identificador</th>";
			echo "<th>Endereço</th>";
			echo "<th>CEP</th>";
			echo "<th>Detalhar</th>";
			echo "<th>Editar</th>";
			echo "<th>Excluir</th>";
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
				echo "<td>".$this->helper->link("?id=".$model->getId()."&module=Gerencia&action=detalhar_imovel","Detalhar")."</td>";
				echo "<td>".$this->helper->link("?id=".$model->getId()."&module=Gerencia&action=editar_imovel","Editar")."</td>";
				echo "<td>".$this->helper->link("#","Excluir","if(window.confirm('Deseja realmente excluir este Imóvel? Note que todas as Manutenções associadas a ele, incluindo os históricos, serão excluídas.')) window.location = '?id=".$model->getId()."&module=Gerencia&action=excluir_imovel';")."</td>";
				echo "</tr>";
			}
			
			echo "</tbody>";
			echo "</table><br/>";
		?>
		</div>
	</div>
</div>

