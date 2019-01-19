<?php 

$roots = $_SERVER['DOCUMENT_ROOT'].'/pfe/';
	include_once($roots.'controller/loader.php');
$template = $twig->loadTemplate('admin/listeretud.twig');
    echo $template->render(array(
    	'title'=>'Lister les étudiants',
    	'user'=>$_SESSION['user'],
    	'etudiants'=>Etudiant::getlist()
    	)
    	); 
 ?>