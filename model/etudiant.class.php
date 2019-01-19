<?php 
$root = $_SERVER['DOCUMENT_ROOT'].'/pfe/';
require_once($root.'tools/dbconnection.php');
class Etudiant{ 
/* les attributs*/
var $id;
var $matricule;
var $nom;
var $prenom;
var $date_naissance;
var $mail;
var $gsm;
var $id_groupe;
var $id_compte;


/* -----------------------------------
		constructeur
-------------------------------*/
//*
function __construct(){

	$this->nom='';
	$this->prenom='';
	$this->matricule='';
	$this->date_naissance="";
	$this->gsm="";
	$this->mail="";
	$this->id_groupe=0;
	$this->id_compte=0;

	
}
static function makeObjEtudiant($etudiant){
	$e = new Etudiant($etudiant['nom'],$etudiant['prenom'],$etudiant['matricule']);
	$e->date_naissance = $etudiant['date_naissance'];
	$e->id=$etudiant['id'];
	$e->mail = $etudiant['mail'];
	$e->gsm=$etudiant['gsm'];
	$e->id_groupe = $etudiant['id_groupe'];
	$e->id_compte = $etudiant['id_compte'];
	return $e;

}
//*/
/*function __construct($id,$nom, $prenom, $matricule,$date_naissance,$gsm,$mail,$grp,$parent,$cmpte){
$this->id=$id;
	$this->nom=$nom;
	$this->prenom=$prenom;
	$this->matricule=$matricule;
	$this->date_naissance="";
	$this->gsm=$gsm;
	$this->mail=$mail;
	$this->id_groupe=$grp;
	$this->id_parent=$parent;
	$this->id_compte=$cmpte;

	
}*/

function create(){
	 $bdd = dbConnect();
	$sql="INSERT INTO `etudiant` (nom, prenom, matricule, date_naissance, mail, gsm,id_compte,id_groupe) VALUES(:nom, :prenom, :matricule,:date_naissance, :mail, :gsm,:compte,:groupe)";
		
	$result = $bdd->prepare($sql);	
	$r = $result->execute(
		array(
			':nom'=>$this->nom,
			':prenom'=>$this->prenom,
			':matricule'=>$this->matricule,
			':date_naissance'=>$this->date_naissance,
			':mail'=>$this->mail,
			':gsm'=>$this->gsm,
			':compte'=>$this->id_compte,
			':groupe'=>$this->id_groupe
			)
		);
	$this->id = $bdd->lastInsertId();
	return $r;

}
static function delete($id){
$sql="DELETE FROM `etudiant` WHERE `id`=:id";
$bdd = dbConnect();
$result = $bdd->prepare($sql);
	return $result->execute(array(':id'=>$id));
	 


}

static function getlist(){
	$bdd = dbConnect();
	$sql="SELECT * FROM `etudiant`";

	$result= $bdd->query($sql);
	
	return $result->fetchAll(PDO::FETCH_ASSOC);
}
//*
static function getById($etudiantId){
	$bdd = dbConnect();
	$query = 'SELECT * FROM `etudiant` WHERE id = :id';
	$result = $bdd->prepare($query);
	$result->execute(array(':id'=>$etudiantId));
	return $result->fetchAll(PDO::FETCH_ASSOC);
	/*$etudiant = new Etudiant($data[0]['id'],$data[0]['nom'],$data[0]['prenom'],$data[0]['matricule'],$data[0]['date_naissance'],$data[0]['gsm'],$data[0]['mail'],$data[0]['id_groupe'],$data[0]['id_parent'],$data[0]['id_compte']);*/
	
}
static function getByIdCompte($id_compte){
	$bdd = dbConnect();
	$query = 'SELECT * FROM `etudiant` WHERE id_compte = :id_compte';
	$result = $bdd->prepare($query);
	$result->execute(array(':id_compte'=>$id_compte));
	return $result->fetchAll();
	
}

function update(){
	$bdd = dbConnect();
	$query = "UPDATE `etudiant` SET `nom`=:nom,prenom = :prenom, date_naissance = :date_naissance, mail = :mail,gsm=:gsm,matricule=:matricule, id_groupe=:id_groupe,id_compte=:id_compte where id=$this->id";
	$result = $bdd->prepare($query);
	try{
		$r = $result->execute(
		array(
			':nom'=>$this->nom,
			':prenom'=>$this->prenom,
			'date_naissance'=>$this->date_naissance,
			':mail'=>$this->mail,
			':gsm'=>$this->gsm,
			':matricule'=>$this->matricule,
			':id_groupe'=>$this->id_groupe,
			':id_compte'=>$this->id_compte
			)
		);
	}catch(Exception $e){
		die("error : ".$e->getMessage());
	}

	return $r;
	
}


}