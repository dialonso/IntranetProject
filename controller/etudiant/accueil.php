<?php 
$roots = $_SERVER['DOCUMENT_ROOT'].'/pfe/';
	include_once($roots.'controller/loader.php');
/*
	echo '<pre>';
 	print_r($_SESSION['user']);
 	echo '</pre>';
	die('');
	//*/
	
	 $template = $twig->loadTemplate('etudiant/index.twig');
    echo $template->render(array(
    	'title'=>'Accueil etudiant',
    	'titre'=>'Page Etudiant',
    	'user'=>$_SESSION['user'])); 