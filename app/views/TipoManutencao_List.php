<div id="app-window-1">	
	<h1>Tipos de Manutenção</h1>
	<div id="app-panel-detail-panel">
		<?php	
			echo "<p>".$this->helper->link("?module=Gerencia&action=editar_tipo_manutencao","Adicionar novo tipo")."</p>";
			
			$categorias = EnumHelper::getCategoriasDeManutencao();
			
			echo "<table class='tbl'>";
			
			echo "<thead>";
			echo "<th>ID</th>";
			echo "<th>Nome</th>";
			echo "<th>Categoria</th>";
			echo "<th>Detalhar</th>";
			echo "<th>Editar</th>";
			echo "<th>Excluir</th>";
			echo "</thead>";
			
			echo"<tbody>";
			if(is_array($this->data["lista"])) foreach($this->data["lista"] as $model)
			{
				echo "<tr>";
				echo "<td>".$model->getId()."</td>";
				echo "<td>".$model->getNome()."</td>";
				echo "<td>".$categorias[$model->getCategoria()]."</td>";
				echo "<td>".$this->helper->link("?id=".$model->getId()."&module=Gerencia&action=detalhar_tipo_manutencao","Detalhar")."</td>";
				echo "<td>".$this->helper->link("?id=".$model->getId()."&module=Gerencia&action=editar_tipo_manutencao","Editar")."</td>";
				echo "<td>".$this->helper->link("#","Excluir","if(window.confirm('Deseja realmente excluir?')) window.location = '?id=".$model->getId()."&module=Gerencia&action=excluir_tipo_manutencao';")."</td>";
				echo "</tr>";
			}
			
			echo "</tbody>";
			echo "</table><br/>";
		?>
	</div>
</div>

