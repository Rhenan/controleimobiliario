<?php
	require_once("../core/File.php");
	
	$file = new File($_FILES['arquivo'],File::PDF);
	
	$file->upload();