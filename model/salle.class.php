<?php 
$root = $_SERVER['DOCUMENT_ROOT'].'/pfe/';
require_once($root.'tools/dbconnection.php');
class Salle{
	/*les attributs*/
	var $id;
	var $nom;

/* -----------------------------------
		constructeur
-------------------------------*/
function __construct(){
	$this->id=0;
	$this->nom= '';

}

static function makeObjSalle($salle){
	$e = new Salle();
	$e->id=$salle['id'];
	$e->nom = $salle['nom'];
	return $e;
}

function create(){
	 $bdd = dbConnect();
	$sql="INSERT INTO `salle` (nom) VALUES(:nom)";
		
	$result = $bdd->prepare($sql);	
	$r = $result->execute(
		array(
			':nom'=>$this->nom
			 )		
			 );
	$this->id = $bdd->lastInsertId();
	return $r;

}

static function getlist(){
	$bdd = dbConnect();
	$sql="SELECT * FROM `salle`";

	$result= $bdd->query($sql);
	
	return $result->fetchAll();
}

static function getById($salleId){
	$bdd = dbConnect();
	$query = 'SELECT * FROM `salle` WHERE id = :id';
	$result = $bdd->prepare($query);
	$result->execute(array(':id'=>$salleId));
	return $result->fetchAll()[0];
		
}

function update(){
	$bdd = dbConnect();
	$query = "UPDATE `salle` SET `nom`=:nom, where id=$this->id";
	$result = $bdd->prepare($query);
	try{
		$r = $result->execute(
		array(
			':nom'=>$this->nom
			));
	}catch(Exception $e){
		die("error : ".$e->getMessage());
	}

	return $r;
	
}


}