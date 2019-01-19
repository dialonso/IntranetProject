<?php 
$root = $_SERVER['DOCUMENT_ROOT'].'/pfe/';
require_once($root.'tools/dbconnection.php');
class Absences{
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

static function makeObjAbsences($absences){
	$e = new Absences();
	$e->id=$absences['id'];
	$e->seance = $absences['seance'];
	$e->matiere = $absences['matiere'];
	$e->duree_seance = $absences['duree_seance'];
	$e->justification = $absences['justification'];
	$e->id_cours = $absences['id_cours'];
	return $e;
}

function create(){
	 $bdd = dbConnect();
	$sql="INSERT INTO `absences` (seance, matiere, duree_seance, justification) VALUES(:seance, :matiere, :duree_seance,:justification)";
		
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
	$sql="SELECT * FROM `absences`";

	$result= $bdd->query($sql);
	
	return $result->fetchAll();
}

static function getById($absencesId){
	$bdd = dbConnect();
	$query = 'SELECT * FROM `absences` WHERE id = :id';
	$result = $bdd->prepare($query);
	$result->execute(array(':id'=>$absencesId));
	return $result->fetchAll()[0];
		
}

function update(){
	$bdd = dbConnect();
	$query = "UPDATE `absences` SET `seance`=:seance,matiere = :matiere, duree_seance = :duree_seance, justification= :justification,id_cours=:id_cours where id=$this->id";
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