<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Login</title>
<link type="text/css" href="app/views/style/login-style.css" rel="stylesheet" />
</head>
<body>
	<div style="width:400px;">
		<div id="login-frame">
			<div id="login-panel">
			<?php
				echo $this->alert;
				echo "<fieldset>";
				echo "<legend><h4>IMOB - Sistema de Gestão de Serviços</h4></legend>";

				echo "<table id='form-table'>";
				echo $this->helper->open_form("Login","index.php");
				echo $this->helper->hidden("module","Index");
				echo $this->helper->hidden("action","submit");
				echo "<tr><td>Usuário: </td><td>".$this->helper->input("usuario","text")."</td></tr>";
				echo "<tr><td>Senha: </td><td>".$this->helper->input("senha","password")."</td></tr>";
				echo "</table>";
				echo "<p>".$this->helper->submit("Logar","submit")."</p>";
				echo $this->helper->close_form();
				echo "</fieldset>";
			?>
			</div>
		</div>
	</div>
</body>
</html>
