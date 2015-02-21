<div id="app-window-1">	
	<h1>Usuários do Sistema</h1>
	<div id="app-panel-detail-panel">
		<?php	 
			echo "<p>".$this->helper->link("?module=Acesso&action=criar_usuario","Criar Novo Usuário");
			
			echo "<br/>";
		
			echo "<table class='tbl'>";
			
			echo "<thead><tr>";
			echo "<th>ID</th>";
			echo "<th>Usuário</th>";
			echo "<th>Nome</th>";
			echo "<th>Resetar</th>";
			echo "<th>Desativar</th>";
			echo "</tr></thead>";
			
			echo"<tbody>";
			if(is_array($this->data["usuarios"])) foreach($this->data["usuarios"] as $model)
			{
				echo "<tr>";
				echo "<td>".$model->getId()."</td>";
				echo "<td>".$model->getUsuario()."</td>";
				echo "<td>".$model->getNome()."</td>";
				echo "<td>".$this->helper->link("#","Resetar Senha","if(window.confirm('Deseja realmente resetar a senha deste usuário?')) window.location = '?id=".$model->getId()."&module=Acesso&action=usuario_resetar_senha';")."</td>";
				echo "<td>".$this->helper->link("#","Desativar Usuário","if(window.confirm('Deseja desativar este usuário?')) window.location = '?id=".$model->getId()."&module=Acesso&action=usuario_desativar';")."</td>";
				echo "</tr>";
			}
			
			echo "</tbody>";
			echo "</table><br/>";
		?>
	</div>
</div>
