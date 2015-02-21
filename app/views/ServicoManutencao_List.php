<div id="app-window-1">	
	<h1>Lista de Serviços de Manutenção</h1>
	<div id="app-panel-detail-panel">
		<?php	
			echo "<table class='tbl'>";
			
			echo "<thead><tr>";
			echo "<th>ID</th>";
			echo "<th>Título</th>";
			echo "<th>Descrição</th>";
			echo "<th>Situação</th>";
			echo "<th>Detalhar</th>";
			echo "</tr></thead>";
			
			echo"<tbody>";
			if(is_array($this->data["lista"])) foreach($this->data["lista"] as $model)
			{
				echo "<tr>";
				echo "<td>".$model->getId()."</td>";
				echo "<td>".$model->getNome()."</td>";
				echo "<td>".$model->getDescricao()."</td>";
				echo "<td>".EnumHelper::getSituacoes()[$model->getSituacao()]."</td>";
				echo "<td>".$this->helper->link("?id=".$model->getId()."&module=Gerencia&action=detalhar_servico_manutencao","Detalhar")."</td>";
				echo "</tr>";
			}
			
			echo "</tbody>";
			echo "</table><br/>";
		?>
	</div>
</div>
