<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title><?=$this->data["page_title"]?></title>
		<link type="text/css" href="app/views/style/basicstyle.css" rel="stylesheet" />
		<script type="text/javascript" src="app/views/js/jquery-1.8.0.min.js"></script>
		<script type="text/javascript" src="app/views/js/jquery-ui-1.8.23.custom.min.js"></script>		
		<script type="text/javascript">
			function confirmar()
			{
				return window.confirm("Deseja realmente fazer isto?");
			}
		
			function select(tr)
			{
				if(tr.className!="selected") tr.className = "selected";
				else tr.className = "";
			}
		</script>
	</head>
	
	<body>
		<div class="layout_all">
			<div id="header">
				<!-- Banner Image -->
				<img src="app/views/style/images/logo.gif" style="width:900px;height:100px;"/>
			</div>
			
			<div id="content">
				<div id="left" class="menu_div">
					<?php 
					if(is_array($this->data["menu_services"]))
					{
						foreach($this->data["menu_services"] as $module=>$srv_list)
						{
							if(!empty($srv_list))
							{
								echo "<div class='title'>".$this->servico_helper->maskServico($module)."</div>";
								foreach($srv_list as $srv)
								{
									echo $this->helper->link("?action=".$srv["acao"]."&module=$module",$srv["nome"]);	
								}
							}
						}
					}
					?>
					<div class='title'>Usuário</div>
					<a href='?module=Principal&action=index'>Principal</a>
					<a href='?module=Index&action=logout'>Sair</a>
				</div>	
				<div id="right">

