<?php 

$roots = $_SERVER['DOCUMENT_ROOT'].'/pfe/';
	include_once($roots.'controller/loader.php');
 if(! empty($_POST)){
 	extract($_POST);

 	extract($_POST);
	$etudiant = new etudiant();
	$etudiant->nom = $nom;
	$etudiant->gsm = $gsm;
	$etudiant->prenom = $prenom;
	$etudiant->matricule =$matricule;
	$etudiant->mail = $mail;
	$etudiant->date_naissance =$datenaissance;

	$etudiant->id_groupe = $groupe;
	$compte = createCompte($matricule,$matricule,2);
	$compte->create();
	$etudiant->id_compte = $compte->id;
	$etudiant->create();
	if (!empty($nomPere)&&!empty($prenomPere)) {
		$Parent = new Parent_etudiant();
		$Parent->nom = $nomPere;
		$Parent->prenom = $prenomPere;
		$Parent->id_etudiant = $etudiant->id;
		$comptePere = createCompte($nomPere.'.'.$prenomPere,'enter',3);
		$comptePere->create();
		$Parent->id_compte = $comptePere->id;
		$Parent->create();
			}
	/*
echo '<pre>';
print_r($etudiant);
print_r($compte);
echo '</pre>';
//*/
//$_SESSION['msg'] = 'Etudiant ajouté avec succès';
//header('Location:/page_intranet/view/admin/ajouteretudiant.php');

$template = $twig->loadTemplate('admin/addetu.twig');
    echo $template->render(array(
    	'title'=>'Ajouter etudiant',
    	'user'=>$_SESSION['user'],
    	'filieres'=>Filiere::getlist(),
    	'message' =>"Etudiant ajouté avec succès [ Login : ".$matricule." Mot de passe : ".$matricule,

    	)
    	);


 	
}else{
	$template = $twig->loadTemplate('admin/addetu.twig');
    echo $template->render(array(
    	'title'=>'Ajouter etudiant',
    	'user'=>$_SESSION['user'],
    	'filieres'=>Filiere::getlist()
    	)
    	); 
}


function createCompte($login,$passe,$idrole){
	$compte = new Compte();
	if(count(Compte::findByLogin($login)) >0 ){
		$login = $login.''.Compte::countAccount()["nombre de compte"];
	}
	$compte->login = $login;
	$compte->password = $passe;
	$compte->etat = 0;
	$compte->image = 'default.jpg';
	$compte->derniere_connexion=0;
	$compte->id_role=$idrole;

	return $compte;
}