<?php 
$root = $_SERVER['DOCUMENT_ROOT'].'/pfe/';
require_once($root.'tools/dbconnection.php');
class Retards{
	/*les attributs*/
var $id;
var $seance;
var $matiere;
var $duree_seance;
var $justification;
var $id_cours;

/* -----------------------------------
		constructeur
-------------------------------*/
function __construct(){

$this->id=0;
$this->seance= '';
$this->matiere= '';
$this->duree_seance= '';
$this->justification=0;
$this->id_cours=0;

}

static function makeObjRetards($retards){
	$e = new retards();
	$e->id=$retards['id'];
	$e->seance = $retards['seance'];
	$e->matiere = $retards['matiere'];
	$e->duree_seance = $retards['duree_seance'];
	$e->justification = $retards['justification'];
	$e->id_cours = $retards['id_cours'];
	return $e;
}

function create(){
	 $bdd = dbConnect();
	$sql="INSERT INTO `retards` (seance, matiere, duree_seance, justification) VALUES(:seance, :matiere, :duree_seance,:justification)";
		
	$result = $bdd->prepare($sql);	
	$r = $result->execute(
		array(
			':seance'=>$this->seance,
			':matiere'=>$this->matiere,
			':duree_seance'=>$this->duree_seance,
			':justification'=>$this->justification,
			 )
						);
	$this->id = $result->lastInsertId();
	return $r;

}

static function getlist(){
	$bdd = dbConnect();
	$sql="SELECT * FROM `retards`";

	$result= $bdd->query($sql);
	
	return $result->fetchAll();
}

static function getById($retardsId){
	$bdd = dbConnect();
	$query = 'SELECT * FROM `retards` WHERE id = :id';
	$result = $bdd->prepare($query);
	$result->execute(array(':id'=>$retardsId));
	return $result->fetchAll()[0];
		
}

function update(){
	$bdd = dbConnect();
	$query = "UPDATE `retards` SET `seance`=:seance,matiere = :matiere, duree_seance = :duree_seance, justification= :justification,id_cours=:id_cours where id=$this->id";
	$result = $bdd->prepare($query);
	try{
		$r = $result->execute(
		array(
			':seance'=>$this->seance,
			':matiere'=>$this->matiere,
			':duree_seance'=>$this->duree_seance,
			':justification'=>$this->justification,
			':id_cours'=>$this->id_cours,
			 )
		);
	}catch(Exception $e){
		die("error : ".$e->getMessage());
	}

	return $r;
	
}


}