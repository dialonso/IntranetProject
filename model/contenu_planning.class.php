<?php 
$root = $_SERVER['DOCUMENT_ROOT'].'/pfe/';
require_once($root.'tools/dbconnection.php');
class Contenuplanning{
	/*les attributs*/
var $id;
var $jour;
var $horaire;
var $id_planning;
var $id_professeur;
var $id_matiere;
var $id_salle;


/* -----------------------------------
		constructeur
-------------------------------*/
function __construct(){

$this->id=0;
$this->jour= '';
$this->horaire= '';
$this->id_planning=0;
$this->id_professeur=0;
$this->id_matiere=0;
$this->id_salle=0;


}

static function makeObjContenu_planning($contenu_planning){
	$e = new Contenu_planning();
	$e->id=$contenu_planning['id'];
	$e->jour = $contenu_planning['jour'];
	$e->heure_debut = $contenu_planning['heure_debut'];
	$e->duree = $contenu_planning['duree'];
	$e->id_planning = $contenu_planning['id_planning'];
	$e->id_professeur = $contenu_planning['id_professeur'];
	$e->id_matiere = $contenu_planning['id_matiere'];
	$e->id_salle = $contenu_planning['id_salle'];
	return $e;
}

function create(){
	 $bdd = dbConnect();
	$sql = "INSERT INTO `contenu_planning`( `jour`, `horaire`, `id_planning`, `id_professeur`, `id_matiere`, `id_salle`) VALUES (:jour,:horaire,:planning,:prof,:mat,:salle)";
	$result = $bdd->prepare($sql);	
	$r = $result->execute(
		array(
			':jour'=>$this->jour,
			':horaire'=>$this->horaire,
			':prof'=>$this->id_professeur,
			'planning'=>$this->id_planning,
			':mat'=>$this->id_matiere,
			':salle'=>$this->id_salle
			)		
			 );
	$this->id = $bdd->lastInsertId();
	return $r;

}

static function getlist(){
	$bdd = dbConnect();
	$sql="SELECT * FROM `contenu_planning`";

	$result= $bdd->query($sql);
	
	return $result->fetchAll();
}
static function getByPlanningId($planningID){
	$bdd = dbConnect();
	$query = 'SELECT * FROM `contenu_planning` WHERE  id_planning = :id';
	$sql = "SELECT c.horaire, c.jour, c.id_planning,p.nom,p.prenom,m.nom FROM `contenu_planning` c, professeur, p matiere m WHERE c.id_planning = :id";
	$result = $bdd->prepare($query);
	$result->execute(array(':id'=>$planningID));
	
	return $result->fetchAll(PDO::FETCH_ASSOC);//$result->fetchAll();
		
}

static function getById($contenu_planningId){
	$bdd = dbConnect();
	$query = 'SELECT * FROM `contenu_planning` WHERE id = :id';
	$result = $bdd->prepare($query);
	$result->execute(array(':id'=>$contenu_planningId));
	return $result->fetchAll()[0];
		
}

function update(){
	$bdd = dbConnect();
	$query = "UPDATE `contenu_planning` SET `jour`=:jour, heure_debut=:heure_debut, duree=:duree, id_planning=:id_planning, id_professeur=:id_professeur, id_matiere=:id_matiere, id_salle=:id_salle where id=$this->id";
	$result = $bdd->prepare($query);
	try{
		$r = $result->execute(
		array(
			':jour'=>$this->jour,
			':heure_debut'=>$this->heure_debut,			
			':duree'=>$this->duree,
			':id_planning'=>$this->id_planning,
			':id_professeur'=>$this->id_professeur,
			':id_matiere'=>$this->id_matiere,
			':id_salle'=>$this->id_salle
			 )
		);
	}catch(Exception $e){
		die("error : ".$e->getMessage());
	}

	return $r;
	
}


}