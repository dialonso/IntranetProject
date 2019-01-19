<?php 
$root = $_SERVER['DOCUMENT_ROOT'].'/pfe/';
require_once($root.'tools/dbconnection.php');
class Niveau{
	/*les attributs*/
var $id;
var $nom;
var $description;
var $id_filiere;

/* -----------------------------------
		constructeur
-------------------------------*/
function __construct(){

$this->id=0;
$this->nom= '';
$this->description= '';
$this->id_filiere=0;

}

static function makeObjNiveau($niveau){
	$e = new Niveau();
	$e->id=$niveau['id'];
	$e->nom=$niveau['nom'];
	$e->description = $niveau['description'];
	$e->id_filiere = $niveau['id_filiere'];
	return $e;
}

function create(){
	 $bdd = dbConnect();
	$sql="INSERT INTO `niveau` (nom, description) VALUES(:nom, :description)";
		
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
	$sql="SELECT * FROM `niveau`";

	$result= $bdd->query($sql);
	
	return $result->fetchAll();
}

static function getById($niveauId){
	$bdd = dbConnect();
	$query = 'SELECT * FROM `niveau` WHERE id = :id';
	$result = $bdd->prepare($query);
	$result->execute(array(':id'=>$niveauId));
	return $result->fetchAll()[0];
		
}
static function getByFiliereId($filiereId){
	$bdd = dbConnect();
	$query = 'SELECT `id`, `nom`, `description`, `id_filiere` FROM `niveau` WHERE id_filiere = :id';
	$result = $bdd->prepare($query);
	$result->execute(array(':id'=>$filiereId));
	$datas = array();
	while ($data = $result->fetch(PDO::FETCH_ASSOC)) {
		$datas[] = $data;
	}
	return $datas;//$result->fetchAll();
		
}

function update(){
	$bdd = dbConnect();
	$query = "UPDATE `niveau` SET `nom`=:nom, description=:description, id_filiere=:id_filiere where id=$this->id";
	$result = $bdd->prepare($query);
	try{
		$r = $result->execute(
		array(
			':nom'=>$this->nom,
			':description'=>$this->description,			
			':id_filiere'=>$this->id_filiere
			 )
		);
	}catch(Exception $e){
		die("error : ".$e->getMessage());
	}

	return $r;
	
}


}