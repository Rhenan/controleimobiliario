<?php
	require_once "../app/helper/ServicoHelper.php";
	require_once "../core/DaoEntity.php";
	require_once "../core/Connection.php";
	require_once "../core/ErrorConsole.php";
	
	define("CONF","../app/conf/");
	
	$helper = new ServicoHelper();
	
	$helper->generateServiceTable();
	
	echo "<h2>Aplicação instalada com sucesso.</h2>";
	echo "<p>Não esqueça de apagar este diretório.</p>";