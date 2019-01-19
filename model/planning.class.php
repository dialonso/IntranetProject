<?php 
$root = $_SERVER['DOCUMENT_ROOT'].'/pfe/';
require_once($root.'tools/dbconnection.php');
class Planning{
	/*les attributs*/
var $id;
var $nom;
var $date_debut;
var $date_fin;
var $id_groupe;

/* -----------------------------------
		constructeur
-------------------------------*/
function __construct(){

$this->id=0;
$this->nom='';
$this->date_debut= '';
$this->date_fin= '';
$this->id_groupe=0;

}

static function makeObjPlanning($planning){
	$e= new Planning();
	$e->id=$planning['id'];
	$e->nom = $planning['nom'];
	$e->date_debut = $planning['date_debut'];
	$e->date_fin = $planning['date_fin'];
	$e->id_groupe = $planning['id_groupe'];
	return $e;
}

function create(){
	 $bdd = dbConnect();
	$sql="INSERT INTO `planning` (nom, date_debut, date_fin, id_groupe) VALUES(:nom, :date_debut, :date_fin, :id_groupe)";
		
	$result = $bdd->prepare($sql);	
	$r = $result->execute(
		array(
			':nom'=>$this->nom,
			':date_debut'=>$this->date_debut,
			':date_fin'=>$this->date_fin,
			':id_groupe'=>$this->id_groupe

			 )
						);
	$this->id = $bdd->lastInsertId();
	return $r;

}

static function getlist(){
	$bdd = dbConnect();
	$sql="SELECT * FROM `planning`";

	$result= $bdd->query($sql);
	
	return $result->fetchAll();
}

static function getById($planningId){
	$bdd = dbConnect();
	$query = 'SELECT * FROM `planning` WHERE id = :id';
	$result = $bdd->prepare($query);
	$result->execute(array(':id'=>$planningId));
	return $result->fetchAll()[0];
		
}
static function getByGroupeId($groupeId){
	$bdd = dbConnect();
	$query = 'SELECT * FROM `planning` WHERE id_groupe = :id';
	$result = $bdd->prepare($query);
	$result->execute(array(':id'=>$groupeId));
	return $result->fetchAll(PDO::FETCH_ASSOC)[0];
		
}

function update(){
	$bdd = dbConnect();
	$query = "UPDATE `planning` SET `nom`=:nom, date_debut=:date_debut, date_fin = :date_fin, id_groupe=:id_groupe where id=$this->id";
	$result = $bdd->prepare($query);
	try{
		$r = $result->execute(
		array(
			':nom'=>$this->nom,
			':date_debut'=>$this->date_debut,
			':date_fin'=>$this->date_fin,
			':id_groupe'=>$this->id_groupe
			 )
		);
	}catch(Exception $e){
		die("error : ".$e->getMessage());
	}

	return $r;
	
}


}