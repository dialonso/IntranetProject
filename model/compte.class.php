<?php 
$root = $_SERVER['DOCUMENT_ROOT'].'/pfe/';
require_once($root.'tools/dbconnection.php');
class Compte{
	/*les attributs*/
var $id;
var $login;
var $password;
var $etat;
var $image;
var $derniere_connexion;
var $id_role;

/* -----------------------------------
		constructeur
-------------------------------*/
function __construct(){

$this->id=0;
$this->login='';
$this->password='';
$this->etat= '';
$this->image='';
$this->derniere_connexion='';
$this->id_role=0;

}
public function getId(){
	return $this->id;
}
/*
	le nombre de compte utilisateur;
*/
static function countAccount(){
	$bdd = dbConnect();
	$query = 'SELECT count(*) as "nombre de compte" FROM `compte`';
	$result = $bdd->prepare($query);
	$result->execute();
	return $result->fetchAll(PDO::FETCH_ASSOC);
}

static function makeObjCompte($compte){
	$e = new Compte();
	$e->id=$compte['id'];
	$e->login = $compte['login'];
	$e->password = $compte['password'];
	$e->etat = $compte['etat'];
	$e->image = $compte['image'];
	$e->derniere_connexion = $compte['derniere_connexion'];
	$e->id_role = $compte['id_role'];
	return $e;
}

function create(){
	 $bdd = dbConnect();
	$sql="INSERT INTO `compte` (login, password, etat, image, derniere_connexion, id_role) VALUES(:login, :password, :etat,:image, :derniere_connexion, :id_role)";
		
	$result = $bdd->prepare($sql);
		
	$r = $result->execute(
		array(
			':login'=>$this->login,
			':password'=>$this->password,
			':etat'=>$this->etat,
			':image'=>$this->image,
			':derniere_connexion'=>$this->derniere_connexion,
			':id_role'=>$this->id_role
			 )
			);
	$this->id = $bdd->lastInsertId();
	return $r;

}

static function findByLogin($login){
	$bdd = dbConnect();
	$query = 'SELECT * FROM `compte` WHERE login = :login';
	$result = $bdd->prepare($query);
	$result->execute(array(':login'=>$login));
	return $result->fetchAll(PDO::FETCH_ASSOC);
}
static function getlist(){
	$bdd = dbConnect();
	$sql="SELECT * FROM `compte`";
	$result= $bdd->query($sql);
	return $result->fetchAll(PDO::FETCH_ASSOC);
}

static function getById($compteId){
	$bdd = dbConnect();
	$query = 'SELECT * FROM `compte` WHERE id = :id';
	$result = $bdd->prepare($query);
	$result->execute(array(':id'=>$compteId));
	return $result->fetchAll(PDO::FETCH_ASSOC)[0];
		
}

function update(){
	$bdd = dbConnect();
	$query = "UPDATE `compte` SET `login`=:login, password=:password, etat = :etat, image= :image,derniere_connexion=:derniere_connexion where id=$this->id";
	$result = $bdd->prepare($query);
	try{
		$r = $result->execute(
		array(
			':login'=>$this->login,
			':password'=>$this->password,
			':etat'=>$this->etat,
			':image'=>$this->image,
			':derniere_connexion'=>$this->derniere_connexion
			 )
		);
	}catch(Exception $e){
		die("error : ".$e->getMessage());
	}

	return $r;
	
}


}