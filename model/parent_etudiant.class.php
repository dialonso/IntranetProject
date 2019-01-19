<?php 
$root = $_SERVER['DOCUMENT_ROOT'].'/pfe/';
require_once($root.'tools/dbconnection.php');
class Parent_etudiant{
	/*les attributs*/
var $id;
var $nom;
var $prenom;
var $id_etudiant;
var $id_compte;

/* -----------------------------------
		constructeur
-------------------------------*/
function __construct(){

$this->id=0;
$this->nom= '';
$this->prenom= '';
$this->id_etudiant=0;
$this->id_compte=0;

}

static function makeObjParent_etudiant($parent_etudiant){
	$e = new Parent_etudiant($parent_etudiant['nom'],$parent_etudiant['prenom']);
	$e->id=$parent_etudiant['id'];
	$e->id_etudiant = $parent_etudiant['id_etudiant'];
	$e->id_compte = $parent_etudiant['id_compte'];
	return $e;

}

function create(){
	 $bdd = dbConnect();
	$sql="INSERT INTO `parent_etudiant` (nom, prenom, id_etudiant, id_compte) VALUES(:nom, :prenom, :id_etudiant, :id_compte)";
		
	$result = $bdd->prepare($sql);	
	$r = $result->execute(
		array(
			':nom'=>$this->nom,
			':prenom'=>$this->prenom,
			':id_etudiant'=>$this->id_etudiant,
			':id_compte'=>$this->id_compte

			 )
		);
	$this->id = $bdd->lastInsertId();
	return $r;

}

static function getlist(){
	$bdd = dbConnect();
	$sql="SELECT * FROM `parent_etudiant`";

	$result= $bdd->query($sql);
	
	return $result->fetchAll();
}

static function getById($parent_etudiantId){
	$bdd = dbConnect();
	$query = 'SELECT * FROM `parent_etudiant` WHERE id = :id';
	$result = $bdd->prepare($query);
	$result->execute(array(':id'=>$parent_etudiantId));
	return $result->fetchAll()[0];
	
	
}

function update(){
	$bdd = dbConnect();
	$query = "UPDATE `parent_etudiant` SET `nom`=:nom, prenom = :prenom, id_etudiant = :id_etudiant, id_compte=:id_compte where id=$this->id";
	$result = $bdd->prepare($query);
	try{
		$r = $result->execute(
		array(
			':nom'=>$this->nom,
			':prenom'=>$this->prenom,
			':id_etudiant'=>$this->id_etudiant,
			':id_compte'=>$this->id_compte
			)
		);
	}catch(Exception $e){
		die("error : ".$e->getMessage());
	}

	return $r;
	
}


}