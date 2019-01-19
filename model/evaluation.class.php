<?php 
$root = $_SERVER['DOCUMENT_ROOT'].'/pfe/';
require_once($root.'tools/dbconnection.php');
class Evaluation{
	/*les attributs*/
var $id;
var $nom;
var $description;
var $date;
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
$this->date= '';
$this->id_classe=0;
$this->id_professeur=0;
$this->id_matiere=0;


}


static function makeObjEvaluation($evaluation){
	$e = new Evaluation();
	$e->id=$evaluation['id'];
	$e->nom = $evaluation['nom'];
	$e->description = $evaluation['description'];
	$e->date = $evaluation['date'];
	$e->id_classe = $evaluation['id_classe'];
	$e->id_professeur = $evaluation['id_professeur'];
	$e->id_matiere = $evaluation['id_matiere'];
	return $e;
}

function create(){
	 $bdd = dbConnect();
	$sql="INSERT INTO `evaluation` (nom, description, date) VALUES(:nom, :description, :date)";
	$result = $bdd->prepare($sql);	
	$r = $result->execute(
		array(
			':nom'=>$this->nom,
			':description'=>$this->description,
			':date'=>$this->date
			 )
						);
	$this->id = $result->lastInsertId();
	return $r;

}

static function getlist(){
	$bdd = dbConnect();
	$sql="SELECT * FROM `evaluation`";

	$result= $bdd->query($sql);
	
	return $result->fetchAll();
}

static function getById($evaluationId){
	$bdd = dbConnect();
	$query = 'SELECT * FROM `evaluation` WHERE id = :id';
	$result = $bdd->prepare($query);
	$result->execute(array(':id'=>$evaluationId));
	return $result->fetchAll()[0];
		
}

function update(){
	$bdd = dbConnect();
	$query = "UPDATE `evaluation` SET `nom`=:nom, description=:description, date=:date, id_classe=:id_classe, id_professeur=:id_professeur, id_matiere=:id_matiere  where id=$this->id";
	$result = $bdd->prepare($query);
	try{
		$r = $result->execute(
		array(
			':nom'=>$this->nom,
			':description'=>$this->description,
			':date'=>$this->date,
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