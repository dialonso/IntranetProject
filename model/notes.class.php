<?php 
$root = $_SERVER['DOCUMENT_ROOT'].'/pfe/';
require_once($root.'tools/dbconnection.php');
class Notes{ 
/* les attributs*/
var $id;
var $date;
var $type;
var $semestre;
var $moyenne;
var $id_etudiant;
var $id_evaluation;

/* -----------------------------------
		constructeur
-------------------------------*/
function __construct(){

	$this->id=0;
	$this->date='';
	$this->type='';
	$this->semestre='';
	$this->moyenne=0;
	$this->id_etudiant=0;
	$this->id_evaluation=0;
	
}

static function makeObjNotes($notes){
	$e = new Notes();
	$e->id=$notes['id'];
	$e->date = $notes['date'];
	$e->type = $notes['type'];
	$e->semestre = $notes['semestre'];
	$e->moyenne = $notes['moyenne'];
	$e->id_etudiant = $notes['id_etudiant'];
	$e->id_evaluation = $notes['id_evaluation'];
	return $e;
}

function create(){
	 $bdd = dbConnect();
	$sql="INSERT INTO `notes` (date, type, semestre, moyenne) VALUES(:date, :type, :semestre,:moyenne)";
		
	$result = $bdd->prepare($sql);	
	$r = $result->execute(
		array(
			':date'=>$this->date,
			':type'=>$this->type,
			':semestre'=>$this->semestre,
			':moyenne'=>$this->moyenne,
			
			 )
						);
	$this->id = $result->lastInsertId();
	return $r;

}

static function getlist(){
	$bdd = dbConnect();
	$sql="SELECT * FROM `notes`";

	$result= $bdd->query($sql);
	
	return $result->fetchAll();
}

static function getById($notesId){
	$bdd = dbConnect();
	$query = 'SELECT * FROM `notes` WHERE id = :id';
	$result = $bdd->prepare($query);
	$result->execute(array(':id'=>$notesId));
	return $result->fetchAll()[0];
		
}

function update(){
	$bdd = dbConnect();
	$query = "UPDATE `notes` SET `date`=:date, type=:type, semestre = :semestre, moyenne= :moyenne, id_etudiant=:id_etudiant,id_evaluation=:id_evaluation where id=$this->id";
	$result = $bdd->prepare($query);
	try{
		$r = $result->execute(
		array(
			':date'=>$this->date,
			':type'=>$this->type,
			':semestre'=>$this->semestre,
			':moyenne'=>$this->moyenne,
			':id_etudiant'=>$this->id_etudiant,
			':id_evaluation'=>$this->id_evaluation
			 )
		);
	}catch(Exception $e){
		die("error : ".$e->getMessage());
	}

	return $r;
	
}


}