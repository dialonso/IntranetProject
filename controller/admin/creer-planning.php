<?php 
$roots = $_SERVER['DOCUMENT_ROOT'].'/pfe/';
	include_once($roots.'controller/loader.php');
 if(! empty($_POST)){
 	extract($_POST);
 }else{
 	$heures = array("08h30-10h00","10h15-11h45","12h30-14h00","14h15-15h45","16h00-17h30","17h35-19h05");
 	$jours = array("lundi","mardi","mercredi","jeudi","vendredi","samedi");
 	$template = $twig->loadTemplate('admin/planning.twig');
    echo $template->render(array(
    	'title'=>'Ajouter un planning',
    	'user'=>$_SESSION['user'],
    	'classes'=>Classe::getlist(),
    	'jours'=>$jours,
    	'heures'=>$heures
    	)
    	); 
 }