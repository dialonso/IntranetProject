<?php
 include_once('loader.php');
$rootPath = '/pfe/';
 	if(! empty($_POST)){
 		extract($_POST);
 		$table = Compte::findByLogin($login);

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
						$_SESSION['msg'] = "Ce compte n'est pas attribué ";
						header('Location:'.$rootPath);
					}else{
						$user['perso'] = $etu[0];
						$_SESSION['user'] = $user;
						unset($_SESSION["msg"]);
						header('Location:'.$rootPath.'controller/admin/accueil.php');
						//header('Location:'.$rootPath.'accueil-admin');
					}

					
					
				}
				else if($role['code'] == 2){

					$etu = Etudiant::getByIdCompte($user['compte']['id']);
					if(count($etu) == 0){
						$_SESSION['msg'] = "Ce compte n'est pas attribué ";
						header('Location:'.$rootPath);
					}else{
						$user['perso'] = $etu[0];
						$_SESSION['user'] = $user;
						unset($_SESSION["msg"]);
						header('Location:'.$rootPath.'view/etudiant/accueil_etudiant.php');
					}

					
				}
				else if($role['code'] == 3){}
					}
				
			
	}else{
		$_SESSION['msg'] = 'Login incorrect';
		header('Location:'.$rootPath);
	}


 	}else{

 		$template = $twig->loadTemplate('login.twig');
    echo $template->render(array(
	'moteur_name' => 'Twig',
	'nom'=> 'Junior Aby'
    )); 
 	}
    
?>