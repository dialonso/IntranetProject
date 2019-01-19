<?php 
$root = $_SERVER['DOCUMENT_ROOT'].'/pfe/';
require_once($root.'tools/dbconnection.php');
class Professeur{
	/*les attributs*/
var $id;
var $nom;
var $prenom;
var $nom_matiere;
var $id_compte;
/* -----------------------------------
		constructeur
-------------------------------*/
function __construct(){

$this->id=0;
$this->nom= '';
$this->prenom= '';
$this->nom_matiere= '';
$this->id_compte=0;
 
}

static function makeObjProfesseur($professeur){
	$e = new Professeur($professeur['nom'],$professeur['prenom']);
	$e->id=$professeur['id'];
	$e->nom_matiere = $professeur['nom_matiere'];
	$e->id_compte = $professeur['id_compte'];
	return $e;

}

function create(){
	 $bdd = dbConnect();
	$sql="INSERT INTO `professeur` (nom, prenom, nom_matiere, id_compte) VALUES(:nom, :prenom, :nom_matiere, :id_compte)";
		
	$result = $bdd->prepare($sql);	
	$r = $result->execute(
		array(
			':nom'=>$this->nom,
			':prenom'=>$this->prenom,
			':nom_matiere'=>$this->nom_matiere,
			':id_compte'=>$this->id_compte
			)
		);
	$this->id = $bdd->lastInsertId();
	return $r;

}

static function getlist(){
	$bdd = dbConnect();
	$sql="SELECT * FROM `professeur`";

	$result= $bdd->query($sql);
	
	return $result->fetchAll();
}

static function getById($professeurId){
	$bdd = dbConnect();
	$query = 'SELECT * FROM `professeur` WHERE id = :id';
	$result = $bdd->prepare($query);
	$result->execute(array(':id'=>$professeurId));
	return $result->fetchAll()[0];
	
	
}

function update(){
	$bdd = dbConnect();
	$query = "UPDATE `professeur` SET `nom`=:nom, prenom = :prenom, nom_matiere = :nom_matiere, id_compte=:id_compte where id=$this->id";
	$result = $bdd->prepare($query);
	try{
		$r = $result->execute(
		array(
			':nom'=>$this->nom,
			':prenom'=>$this->prenom,
			'nom_matiere'=>$this->nom_matiere,
			':id_compte'=>$this->id_compte
			)
		);
	}catch(Exception $e){
		die("error : ".$e->getMessage());
	}

	return $r;
	
}


}