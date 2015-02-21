<div id="app-window-1">	
	<h1>Alterar Senha</h1>
	<div id="app-panel-detail-panel">
	<?php
		echo $this->helper->open_form("senha","index.php");
		echo $this->helper->hidden("module","Acesso");
		echo $this->helper->hidden("action","usuario_trocar_senha_salvar");
	
		echo "<p>Senha Antiga: ".$this->helper->input("senha","password")."</p>";
		echo "<p>Nova Senha: ".$this->helper->input("novaSenha","password")."</p>";
		echo "<p>Nova Senha: ".$this->helper->input("novaSenhaConfirmar","password")."</p>";
	
		echo "<p>".$this->helper->submit("Enviar")."</p>";
			
		$this->helper->close_form();
	?>
	</div>
</div>



