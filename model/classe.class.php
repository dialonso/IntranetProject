<?php 
$root = $_SERVER['DOCUMENT_ROOT'].'/pfe/';
require_once($root.'tools/dbconnection.php');
class Classe{
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
$this->nom='';
$this->description='';
$this->id_niveau=0;

}

static function makeObjClasse($classe){
	$e = new Classe();
	$e->id=$classe['id'];
	$e->nom = $classe['nom'];
	$e->description = $classe['description'];
	$e->id_niveau = $classe['id_niveau'];
	return $e;
}

function create(){
	 $bdd = dbConnect();
	$sql="INSERT INTO `classe` (nom, description) VALUES(:nom, :description)";
		
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

static function getByNiveauId($niveauID){
	$bdd = dbConnect();
	$query = 'SELECT * FROM `classe` WHERE id_niveau = :id';
	$result = $bdd->prepare($query);
	$result->execute(array(':id'=>$niveauID));
	$datas = array();
	while ($data = $result->fetch(PDO::FETCH_ASSOC)) {
		$datas[] = $data;
	}
	return $datas;//$result->fetchAll();
		
}
static function getlist(){
	$bdd = dbConnect();
	$sql="SELECT * FROM `classe`";

	$result= $bdd->query($sql);
	
	return $result->fetchAll();
}

static function getById($classeId){
	$bdd = dbConnect();
	$query = 'SELECT * FROM `classe` WHERE id = :id';
	$result = $bdd->prepare($query);
	$result->execute(array(':id'=>$classeId));
	return $result->fetchAll()[0];
		
}

function update(){
	$bdd = dbConnect();
	$query = "UPDATE `classe` SET `nom`=:nom, description=:description, id_niveau=:id_niveau where id=$this->id";
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