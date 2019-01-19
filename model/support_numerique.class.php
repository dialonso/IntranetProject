<?php 
$root = $_SERVER['DOCUMENT_ROOT'].'/pfe/';
require_once($root.'tools/dbconnection.php');
class Support_numerique{ 
/* les attributs*/
var $id;
var $nom;
var $description;
var $date_publication;
var $id_matiere;
var $id_professeur;

/* -----------------------------------
		constructeur
-------------------------------*/
function __construct(){

	$this->id=0;
	$this->nom="";
	$this->description="";
	$this->date_publication="";
	$this->id_matiere=0;
	$this->id_professeur=0;

}

static function makeObjSupport_numerique($support_numerique){
	$e= new Support_numerique();
	$e->id=$support_numerique['id'];
	$e->nom = $support_numerique['nom'];
	$e->description = $support_numerique['description'];
	$e->date_publication = $support_numerique['date_publication'];
	$e->id_matiere = $support_numerique['id_matiere'];
	$e->id_professeur = $support_numerique['id_professeur'];
	return $e;
}

function create(){
	 $bdd = dbConnect();
	$sql="INSERT INTO `support_numerique` (nom, description, date_publication) VALUES(:nom, :description, :date_publication)";
		
	$result = $bdd->prepare($sql);	
	$r = $result->execute(
		array(
			':nom'=>$this->nom,
			':description'=>$this->description,
			':date_publication'=>$this->date_publication
			 )
						);
	$this->id = $result->lastInsertId();
	return $r;

}

static function getlist(){
	$bdd = dbConnect();
	$sql="SELECT * FROM `support_numerique`";

	$result= $bdd->query($sql);
	
	return $result->fetchAll();
}

static function getById($support_numeriqueId){
	$bdd = dbConnect();
	$query = 'SELECT * FROM `support_numerique` WHERE id = :id';
	$result = $bdd->prepare($query);
	$result->execute(array(':id'=>$support_numeriqueId));
	return $result->fetchAll()[0];
		
}

function update(){
	$bdd = dbConnect();
	$query = "UPDATE `support_numerique` SET `nom`=:nom, description=:description, date_publication = :date_publication, id_matiere=:id_matiere,id_professeur=:id_professeur where id=$this->id";
	$result = $bdd->prepare($query);
	try{
		$r = $result->execute(
		array(
			':nom'=>$this->nom,
			':description'=>$this->description,
			':date_publication'=>$this->date_publication,
			':id_matiere'=>$this->id_matiere,
			':id_professeur'=>$this->id_professeur
			 )
		);
	}catch(Exception $e){
		die("error : ".$e->getMessage());
	}

	return $r;
	
}


}