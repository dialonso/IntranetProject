<?php 
$root = $_SERVER['DOCUMENT_ROOT'].'/pfe/';
require_once($root.'tools/dbconnection.php');
class Filiere{
	/*les attributs*/
var $id;
var $nom;
var $description;
var $annee_creation;

/* -----------------------------------
		constructeur
-------------------------------*/
function __construct(){

$this->id=0;
$this->nom= '';
$this->description= '';
$this->annee_creation=0;
}


static function makeObjFiliere($filiere){
	$e = new Filiere();
	$e->id=$filiere['id'];
	$e->nom = $filiere['nom'];
	$e->description = $filiere['description'];
	$e->annee_creation = $filiere['annee_creation'];
	return $e;
}

function create(){
	 $bdd = dbConnect();
	$sql="INSERT INTO `filiere` (nom, description) VALUES(:nom, :description)";
		
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
	$sql="SELECT * FROM `filiere`";

	$result= $bdd->query($sql);
	
	return $result->fetchAll();
}

static function getById($filiereId){
	$bdd = dbConnect();
	$query = 'SELECT * FROM `filiere` WHERE id = :id';
	$result = $bdd->prepare($query);
	$result->execute(array(':id'=>$filiereId));
	return $result->fetchAll()[0];
		
}

function update(){
	$bdd = dbConnect();
	$query = "UPDATE `filiere` SET `nom`=:nom, description=:description, annee_creation=:annee_creation where id=$this->id";
	$result = $bdd->prepare($query);
	try{
		$r = $result->execute(
		array(
			':nom'=>$this->nom,
			':description'=>$this->description,			
			':annee_creation'=>$this->annee_creation
			 )
		);
	}catch(Exception $e){
		die("error : ".$e->getMessage());
	}

	return $r;
	
}


}