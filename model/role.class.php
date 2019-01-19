<?php 
$root = $_SERVER['DOCUMENT_ROOT'].'/pfe/';
require_once($root.'tools/dbconnection.php');
class Role{
	/*les attributs*/
	var $id;
	var $nom;
	var $description;
	var $code;

/* -----------------------------------
		constructeur
-------------------------------*/
function __construct(){
	$this->id=0;
	$this->nom= '';
	$this->code=0;
	$this->description= '';

}

static function makeObjRole($role){
	$e = new Role();
	$e->id=$role['id'];
	$e->nom = $role['nom'];
	$e->description = $role['description'];
	$e->code = $role['code'];
	return $e;
}

function create(){
	 $bdd = dbConnect();
	$sql="INSERT INTO `role` (nom) VALUES(:nom)";
		
	$result = $bdd->prepare($sql);	
	$r = $result->execute(
		array(
			':nom'=>$this->nom
			 )		
			 );
	$this->id = $result->lastInsertId();
	return $r;

}

static function getlist(){
	$bdd = dbConnect();
	$sql="SELECT * FROM `role`";

	$result= $bdd->query($sql);
	
	return $result->fetchAll();
}

static function getById($roleId){
	$bdd = dbConnect();
	$query = 'SELECT * FROM `role` WHERE id = :id';
	$result = $bdd->prepare($query);
	$result->execute(array(':id'=>$roleId));
	return $result->fetchAll()[0];
		
}

function update(){
	$bdd = dbConnect();
	$query = "UPDATE `role` SET `nom`=:nom, code=:code where id=$this->id";
	$result = $bdd->prepare($query);
	try{
		$r = $result->execute(
		array(
			':nom'=>$this->nom,
			':code'=>$this->code
			 )
		);
	}catch(Exception $e){
		die("error : ".$e->getMessage());
	}

	return $r;
	
}


}