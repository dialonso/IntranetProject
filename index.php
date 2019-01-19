<?php
include_once('loader.php');
$rootPath = '/pfe/';
 if(! empty($_POST)){
 	extract($_POST);
 	

 	$table = Compte::findByLogin($login);
/*
 	echo '<pre>';
 	print_r($table);
 	echo '</pre>';
 	die('count :'.count($table));
 //*/
 		if(count($table)>0){
			$mpdb = $table[0]["password"];
			if($mpdb != $pass){
				$template = $twig->loadTemplate('login.twig');
			    echo $template->render(array(
				'erreur' => 'mot de passe incorrect'
			    ));
			     
			}else{
				$role = Role::getById($table[0]["id_role"]);
				$user = array();
				$user['compte']=$table[0];
				$user['role'] = $role;
				

				if($role['code'] == 1){

					$etu = Membre_administration::getByIdCompte($user['compte']['id']);
					if(count($etu) == 0){
						$template = $twig->loadTemplate('login.twig');
					    echo $template->render(array(
						'erreur' => "Ce compte n'est pas attribué "
					    ));
					}else{
						$user['perso'] = $etu[0];
						$_SESSION['user'] = $user;
						unset($_SESSION["msg"]);
						header('Location:/pfe/controller/admin/accueil.php');
					}	
				}
				else if($role['code'] == 2){

					$etu = Etudiant::getByIdCompte($user['compte']['id']);
					if(count($etu) == 0){
						$template = $twig->loadTemplate('login.twig');
					    echo $template->render(array(
						'erreur' => "Ce compte n'est pas attribué "
					    ));
					}else{
						$user['perso'] = $etu[0];
						$_SESSION['user'] = $user;
						unset($_SESSION["msg"]);
						header('Location:/pfe/controller/etudiant/accueil.php');
						//header('Location:'.$rootPath.'view/etudiant/accueil_etudiant.php');
					}

					
				}
				else if($role['code'] == 3){}
					}
				
			
	}else{
		$template = $twig->loadTemplate('login.twig');
			    echo $template->render(array(
				'erreur' => 'Login incorrect'
			    ));
	}


 	//header('Location:/pfe/controller/admin/accueil.php');
 }else{
 	
    $template = $twig->loadTemplate('login.twig');
    echo $template->render(array()); 
 }
