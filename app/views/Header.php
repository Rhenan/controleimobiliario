<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title><?php echo $this->data["page_title"]; ?></title>
		
		<?php		
			$this->load("VIEW","include_stylesheets");
			$this->load("VIEW","include_javascripts");
		?>
		
	</head>
	
	<body>
		<div id="layout-all">
			<div id="header">
				<div id="header-logo">IMOB - Gestão de Serviços</div>
				<div id="header-user">
						<div id="header-user-left"><img src="app/views/style/img/user_icon.jpg"/></div>
						<div id="header-user-right">
							Bem Vindo
							<br/>
							<?php 
								echo $this->helper->link("?action=usuario_trocar_senha&module=Acesso","Alterar Senha");
								echo " | ";
								echo $this->helper->link("?action=logout&module=Index","Sair");
							?>
						</div>
					</div>
			</div>
			
			<nav id="menu">
				<ul>
			<?php 
					if(is_array($this->data["menu_services"]))
					{
						echo "<li>".$this->helper->link("?module=".ServicoHelper::MODULO_PRINCIPAL,$this->servico_helper->getIconeServico(ServicoHelper::MODULO_PRINCIPAL)."Dashboard")."</li>";
						foreach($this->data["menu_services"] as $module=>$srv_list)
						{
							echo "<li>".$this->helper->link("?action=dashboard_".$module."&module=$module",$this->servico_helper->getIconeServico($module)."".$this->servico_helper->maskServico($module))."</li>";
						}
					}
					?>
				</ul>
			</nav>
			
			<div id="content">
			<?php
				$this->servico_helper->renderMenuModulo($this->request_array["module"],$this->data);
			?>
			
			<div id="app-panel">
			