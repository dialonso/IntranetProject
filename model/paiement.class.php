<?php 
$root = $_SERVER['DOCUMENT_ROOT'].'/pfe/';
require_once($root.'tools/dbconnection.php');
class Paiement{
	/*les attributs*/
var $id;
var $date;
var $type;
var $nature;
var $versement;
var $id_etudiant;
var $id_niveau;



/* -----------------------------------
		constructeur
-------------------------------*/
function __construct(){

$this->id=0;
$this->date= '';
$this->type= '';
$this->nature= '';
$this->versement= '';
$this->id_etudiant=0;
$this->id_niveau=0;


}

static function makeObjPaiement($paiement){
	$e= new Paiement();
	$e->id=$paiement['id'];
	$e->date = $paiement['date'];
	$e->type = $paiement['type'];
	$e->nature = $paiement['nature'];
	$e->versement = $paiement['versement'];
	$e->id_etudiant = $paiement['id_etudiant'];
	$e->id_niveau = $paiement['id_niveau'];
	return $e;
}

function create(){
	 $bdd = dbConnect();
	$sql="INSERT INTO `paiement` (date, type, nature, versement) VALUES(:date, :type, :nature,:versement)";
		
	$result = $bdd->prepare($sql);	
	$r = $result->execute(
		array(
			':date'=>$this->date,
			':type'=>$this->type,
			':nature'=>$this->nature,
			':versement'=>$this->versement,
			
			 )
						);
	$this->id = $result->lastInsertId();
	return $r;

}

static function getlist(){
	$bdd = dbConnect();
	$sql="SELECT * FROM `paiement`";

	$result= $bdd->query($sql);
	
	return $result->fetchAll();
}

static function getById($paiementId){
	$bdd = dbConnect();
	$query = 'SELECT * FROM `paiement` WHERE id = :id';
	$result = $bdd->prepare($query);
	$result->execute(array(':id'=>$paiementId));
	return $result->fetchAll()[0];
		
}

function update(){
	$bdd = dbConnect();
	$query = "UPDATE `paiement` SET `date`=:date, type=:type, nature = :nature, versement= :versement, id_etudiant=:id_etudiant,id_niveau=:id_niveau where id=$this->id";
	$result = $bdd->prepare($query);
	try{
		$r = $result->execute(
		array(
			':date'=>$this->date,
			':type'=>$this->type,
			':nature'=>$this->nature,
			':versement'=>$this->versement,
			':id_etudiant'=>$this->id_etudiant,
			':id_niveau'=>$this->id_niveau
			 )
		);
	}catch(Exception $e){
		die("error : ".$e->getMessage());
	}

	return $r;
	
}


}