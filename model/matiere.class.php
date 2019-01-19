<?php 
$root = $_SERVER['DOCUMENT_ROOT'].'/pfe/';
require_once($root.'tools/dbconnection.php');
class Matiere{
	/*les attributs*/
var $id;
var $nom;
var $description;
var $id_niveau;

/* -----------------------------------
		constructeur
-------------------------------*/
function __construct(){

$this->id=0;
$this->nom= '';
$this->description= '';
$this->id_niveau=0;


}




static function makeObjMatiere($matiere){
	$e = new Matiere();
	$e->id=$matiere['id'];
	$e->nom = $matiere['nom'];
	$e->description = $matiere['description'];
	$e->id_niveau = $matiere['id_niveau'];
	return $e;
}

function create(){
	 $bdd = dbConnect();
	$sql="INSERT INTO `matiere` (nom, description) VALUES(:nom, :description)";
		
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
	$sql="SELECT * FROM `matiere`";

	$result= $bdd->query($sql);
	
	return $result->fetchAll();
}

static function getByNiveau($Idniveau){
	$bdd = dbConnect();
	$query = 'SELECT * FROM `matiere` WHERE id_niveau = :id';
	$result = $bdd->prepare($query);
	$result->execute(array(':id'=>$Idniveau));
	return $result->fetchAll();	
}
static function getById($matiereId){
	$bdd = dbConnect();
	$query = 'SELECT * FROM `matiere` WHERE id = :id';
	$result = $bdd->prepare($query);
	$result->execute(array(':id'=>$matiereId));
	return $result->fetchAll()[0];
		
}


function update(){
	$bdd = dbConnect();
	$query = "UPDATE `matiere` SET `nom`=:nom, description=:description, id_niveau=:id_niveau where id=$this->id";
	$result = $bdd->prepare($query);
	try{
		$r = $result->execute(
		array(
			':nom'=>$this->nom,
			':description'=>$this->description,			
			':id_niveau'=>$this->id_niveau
			 )
		);
	}catch(Exception $e){
		die("error : ".$e->getMessage());
	}

	return $r;
	
}


}