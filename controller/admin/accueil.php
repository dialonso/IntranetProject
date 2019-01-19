<?php 
	$roots = $_SERVER['DOCUMENT_ROOT'].'/pfe/';
	include_once($roots.'controller/loader.php');
/*
	echo '<pre>';
 	print_r($_SESSION['user']);
 	echo '</pre>';
	die('');
	//*/
	
	 $template = $twig->loadTemplate('admin/index.twig');
    echo $template->render(array(
    	'title'=>'Accueil Admin',
    	'titre'=>'Page Administrateur',
    	'user'=>$_SESSION['user'])); 

 ?>