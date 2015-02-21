<div id="app-window-1">	
	<h1>Criar Usuário</h1>
	<div id="app-panel-detail-panel">
	<?php
		echo $this->helper->open_form("usuario_form","index.php");
		echo $this->helper->hidden("module","Acesso");
		echo $this->helper->hidden("action","criar_usuario_salvar");
	
		echo "<p>Login: ".$this->helper->input("login","text")."</p>";
		echo "<p>Nome: ".$this->helper->input("nome","text")."</p>";
		
		$perfis = Array(
				ServicoHelper::GERENTE => ServicoHelper::GERENTE,
				ServicoHelper::INQUILINO => ServicoHelper::INQUILINO,
				ServicoHelper::PROPRIETARIO => ServicoHelper::PROPRIETARIO
		);
		
		echo "<p>Perfil: ".$this->helper->combo("perfil",$perfis)."</p>";
	
		echo "<p>".$this->helper->submit("Criar")."</p>";
			
		$this->helper->close_form();
	?>
	</div>
</div>