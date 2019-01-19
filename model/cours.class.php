<?php 
$root = $_SERVER['DOCUMENT_ROOT'].'/pfe/';
require_once($root.'tools/dbconnection.php');
class Cours{
	/*les attributs*/
var $id;
var $nom;
var $description;
var $id_classe;
var $id_professeur;
var $id_matiere;

/* -----------------------------------
		constructeur
-------------------------------*/
function __construct(){

$this->id=0;
$this->nom= '';
$this->description= '';
$this->id_classe=0;
$this->id_professeur=0;
$this->id_matiere=0;


}

static function makeObjCours($cours){
	$e = new Cours();
	$e->id=$cours['id'];
	$e->nom = $cours['nom'];
	$e->description = $cours['description'];
	$e->id_classe = $cours['id_classe'];
	$e->id_professeur = $cours['id_professeur'];
	$e->id_matiere = $cours['id_matiere'];
	return $e;
}

function create(){
	 $bdd = dbConnect();
	$sql="INSERT INTO `cours` (nom, description) VALUES(:nom, :description)";
	$result = $bdd->prepare($sql);	
	$r = $result->execute(
		array(
			':nom'=>$this->nom,
			':description'=>$this->description
			 )
						);
	$this->id = $result->lastInsertId();
	return $r;

}

static function getlist(){
	$bdd = dbConnect();
	$sql="SELECT * FROM `cours`";

	$result= $bdd->query($sql);
	
	return $result->fetchAll();
}

static function getById($coursId){
	$bdd = dbConnect();
	$query = 'SELECT * FROM `cours` WHERE id = :id';
	$result = $bdd->prepare($query);
	$result->execute(array(':id'=>$coursId));
	return $result->fetchAll()[0];
		
}

function update(){
	$bdd = dbConnect();
	$query = "UPDATE `cours` SET `nom`=:nom, description=:description, id_classe=:id_classe, id_professeur=:id_professeur, id_matiere=:id_matiere  where id=$this->id";
	$result = $bdd->prepare($query);
	try{
		$r = $result->execute(
		array(
			':nom'=>$this->nom,
			':description'=>$this->description,
			':id_classe'=>$this->id_classe,
			':id_professeur'=>$this->id_professeur,
			':id_matiere'=>$this->id_matiere
			 )
		);
	}catch(Exception $e){
		die("error : ".$e->getMessage());
	}

	return $r;
	
}


}