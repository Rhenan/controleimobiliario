<div id="app-window-1">	
	<h1>Lista de Serviços de Manutenção</h1>
	<div id="app-panel-detail-panel">
		<?php	
			echo "<table class='tbl'>";
			
			echo "<thead><tr>";
			echo "<th>ID</th>";
			echo "<th>Nome</th>";
			echo "<th>Data</th>";
			echo "<th>Situação</th>";
			echo "<th>Detalhar</th>";
			echo "</tr></thead>";
			
			echo"<tbody>";
			if(is_array($this->data["listServico"])) foreach($this->data["listServico"] as $model)
			{
				echo "<tr>";
				echo "<td>".$model->getId()."</td>";
				echo "<td>".$model->getNome()."</td>";
				echo "<td>".$this->helper->dataMask($model->getDataAbertura())."</td>";
				echo "<td>".EnumHelper::getSituacoes()[$model->getSituacao()]."</td>";
				echo "<td>".$this->helper->link("?id=".$model->getId()."&module=Inquilino&action=detalhar_servicos_em_aberto","Detalhar")."</td>";
				echo "</tr>";
			}
			
			echo "</tbody>";
			echo "</table><br/>";
		?>
	</div>
</div>
