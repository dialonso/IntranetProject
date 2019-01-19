<?php 
header('Content-Type: text/html; charset=utf-8');
$root = $_SERVER['DOCUMENT_ROOT'].'/pfe/';
require_once($root.'tools/required.php');
$rootPath = '/pfe/';

/*
echo '<pre>';
print_r($_POST);
echo '</pre>';
/*/
//ajax

if(isset($_POST['action'])){
	extract($_POST);
	//echo "action ".$action." id parent :".$id;
	if($action == 'getniveau'){
		$str = "[";
		foreach (Niveau::getByFiliereId($id) as $key => $value) {
			$r = "{";
			foreach ($value as $k => $val) {
				$r .= '"'.$k.'":"'.$val.'",';
			}
			if(strlen($r)>1)
			$r = substr($r, 0,strlen($r)-1);
			$r.='},';
			$str .= $r;
		}
		if(strlen($str)>1)
			$str = substr($str, 0,strlen($str)-1);

		$str .= ']';
		echo ($str);

	}else if($action == 'getclasse'){
		$str = "[";
		foreach (Classe::getByNiveauId($id) as $key => $value) {
			$r = "{";
			foreach ($value as $k => $val) {
				$r .= '"'.$k.'":"'.$val.'",';
			}
			if(strlen($r)>1)
			$r = substr($r, 0,strlen($r)-1);
			$r.='},';
			$str .= $r;
		}
		if(strlen($str)>1)
			$str = substr($str, 0,strlen($str)-1);

		$str .= ']';
		echo ($str);

	}else if($action == 'getgroupe'){
		$str = "[";
		foreach (Groupe::getByClasseId($id) as $key => $value) {
			$r = "{";
			foreach ($value as $k => $val) {
				$r .= '"'.$k.'":"'.$val.'",';
			}
			if(strlen($r)>1)
			$r = substr($r, 0,strlen($r)-1);
			$r.='},';
			$str .= $r;
		}
		if(strlen($str)>1)
			$str = substr($str, 0,strlen($str)-1);

		$str .= ']';
		echo ($str);
	}


}
else{
	extract($_POST);
	$etudiant = new etudiant();
	$etudiant->nom = $nom;
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
	//*
echo '<pre>';
print_r($etudiant);
print_r($compte);
echo '</pre>';
//*/
$_SESSION['msg'] = 'Etudiant ajouté avec succès';
header('Location:/page_intranet/view/admin/ajouteretudiant.php');
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