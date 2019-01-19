<?php 
$root = $_SERVER['DOCUMENT_ROOT'].'/pfe/';
require_once($root.'tools/dbconnection.php');
class Groupe{
	/*les attributs*/
var $id;
var $nom;
var $description;
var $id_classe;

/* -----------------------------------
		constructeur
-------------------------------*/
function __construct(){

$this->id=0;
$this->nom= '';
$this->description= '';
$this->id_classe=0;


}

static function makeObjGroupe($groupe){
	$e = new Groupe();
	$e->id=$groupe['id'];
	$e->nom = $groupe['nom'];
	$e->description = $groupe['description'];
	$e->id_classe = $groupe['id_classe'];
	return $e;
}

function create(){
	 $bdd = dbConnect();
	$sql="INSERT INTO `groupe` (nom, description) VALUES(:nom, :description)";
		
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
	$sql="SELECT * FROM `groupe`";

	$result= $bdd->query($sql);
	
	return $result->fetchAll();
}
static function getByClasseId($classeID){
	$bdd = dbConnect();
	$query = 'SELECT * FROM `groupe` WHERE id_classe = :id';
	$result = $bdd->prepare($query);
	$result->execute(array(':id'=>$classeID));
	$datas = array();
	while ($data = $result->fetch(PDO::FETCH_ASSOC)) {
		$datas[] = $data;
	}
	return $datas;//$result->fetchAll();
		
}
static function getById($groupeId){
	$bdd = dbConnect();
	$query = 'SELECT * FROM `groupe` WHERE id = :id';
	$result = $bdd->prepare($query);
	$result->execute(array(':id'=>$groupeId));
	return $result->fetchAll()[0];
		
}

function update(){
	$bdd = dbConnect();
	$query = "UPDATE `groupe` SET `nom`=:nom, description=:description, id_classe=:id_classe where id=$this->id";
	$result = $bdd->prepare($query);
	try{
		$r = $result->execute(
		array(
			':nom'=>$this->nom,
			':description'=>$this->description,			
			':id_classe'=>$this->id_classe
			 )
		);
	}catch(Exception $e){
		die("error : ".$e->getMessage());
	}

	return $r;
	
}


}