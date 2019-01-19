<?php 
$roots = $_SERVER['DOCUMENT_ROOT'].'/pfe/';
	include_once($roots.'controller/loader.php');

	$heures = array("08h30-10h00","10h15-11h45","12h30-14h00","14h15-15h45","16h00-17h30","17h35-19h05");
 	$jours = array("lundi","mardi","mercredi","jeudi","vendredi","samedi");
 	$groupe = Groupe::getById($_SESSION['user']['perso']['id_groupe']);
 	$planning = Planning::getByGroupeId($groupe['id']);
 	$Contenuplanning = traitementC(Contenuplanning::getByPlanningId($planning['id']));
 	/*
 	echo '<pre>';
 	print_r($Contenuplanning);
 	echo '</pre>';
 	die("");
 	//*/
	 $template = $twig->loadTemplate('etudiant/edt.twig');
    echo $template->render(array(
    	'title'=>'Le planning',
    	'titre'=>'Page Etudiant',
    	'user'=>$_SESSION['user'],
    	'contenus'=>$Contenuplanning,
    	'jours'=>$jours,
    	'heures'=>$heures,
    	'plan'=>$planning,
    	'groupe'=>$groupe)
    ); 

     function traitementC($table){
			$s = array();

			foreach ($table as $key => $value) {
				if($value['id_professeur'] != 0){
					$p = Professeur::getById($value['id_professeur']);
					$value['professeur'] = 'Mr. '.$p['prenom'].' '.$p['nom'];

				}else{
					$value['professeur'] = 'Prof Inconnu';
				}
				if($value['id_matiere'] != 0){
					$p = Matiere::getById($value['id_matiere']);
					$value['matiere'] = $p['nom'];

				}else{
					$value['matiere'] = 'Inconnu';
				}
				if($value['id_salle'] != 0){
					$p = Salle::getById($value['id_salle']);
					$value['salle'] = $p['nom'];

				}else{
					$value['salle'] = 'Salle Inconnu';
				}
				$s[] = $value;
			}
			return $s;
	
	}