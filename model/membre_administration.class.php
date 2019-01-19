<?php 
$root = $_SERVER['DOCUMENT_ROOT'].'/pfe/';
require_once($root.'tools/dbconnection.php');
class Membre_administration{ 
/* les attributs*/
var $id;
var $nom;
var $prenom;
var $date_naissance;
var $poste;
var $id_compte;


/* -----------------------------------
		constructeur
-------------------------------*/
function __construct(){

	$this->id=0;
	$this->nom='';
	$this->prenom='';
	$this->date_naissance='';
	$this->poste='';
	$this->id_compte=0;
	
}

static function makeObjMembre_administration($membre_administration){
	$e = new Membre_administration($membre_administration['nom'],$membre_administration['prenom']);
	$e->id=$membre_administration['id'];
	$e->date_naissance = $membre_administration['date_naissance'];
	$e->poste = $membre_administration['poste'];
	$e->id_compte = $membre_administration['id_compte'];
	return $e;

}

function create(){
	 $bdd = dbConnect();
	$sql="INSERT INTO `membre_administration` (nom, prenom, date_naissance, poste, id_compte) VALUES(:nom, :prenom, :date_naissance, :poste, :id_compte)";
		
	$result = $bdd->prepare($sql);	
	$r = $result->execute(
		array(
			':nom'=>$this->nom,
			':prenom'=>$this->prenom,
			':date_naissance'=>$this->date_naissance,
			':poste'=>$this->poste,
			':id_compte'=>$this->id_compte

			)
		);
	$this->id = $bdd->lastInsertId();
	return $r;

}

static function getlist(){ 
	$bdd = dbConnect();
	$sql="SELECT * FROM `membre_administration`";

	$result= $bdd->query($sql);
	
	return $result->fetchAll();
}

static function getById($membre_administrationId){
	$bdd = dbConnect();
	$query = 'SELECT * FROM `membre_administration` WHERE id = :id';
	$result = $bdd->prepare($query);
	$result->execute(array(':id'=>$membre_administrationId));
	return $result->fetchAll()[0];
	
	
}
static function getByIdCompte($id_compte){
	$bdd = dbConnect();
	$query = 'SELECT * FROM `membre_administration` WHERE id_compte = :id_compte';
	$result = $bdd->prepare($query);
	$result->execute(array(':id_compte'=>$id_compte));
	return $result->fetchAll();
	
}

function update(){
	$bdd = dbConnect();
	$query = "UPDATE `membre_administration` SET `nom`=:nom, prenom = :prenom, date_naissance = :date_naissance, poste=:poste, id_compte=:id_compte where id=$this->id";
	$result = $bdd->prepare($query);
	try{
		$r = $result->execute(
		array(
			':nom'=>$this->nom,
			':prenom'=>$this->prenom,
			'date_naissance'=>$this->date_naissance,
			'poste'=>$this->poste,
			':id_compte'=>$this->id_compte
			)
		);
	}catch(Exception $e){
		die("error : ".$e->getMessage());
	}

	return $r;
	
}


}