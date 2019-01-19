<?php  
header('Content-Type: text/html; charset=utf-8');
$root = $_SERVER['DOCUMENT_ROOT'].'/pfe/';
require_once($root.'tools/required.php');

if(!empty($_POST)){
	extract($_POST);
	if ($action=="EDT") {
	//creation d'un nouveau formulaire
		$planning= new planning();
		$planning->nom=$nom;
		$planning->date_debut=$datedebut;
		$planning->date_fin=$datefin;
		$planning->id_groupe=$groupe;
		$planning->create();
		//$planning->id= 100;
		echo $planning->id;
/*
echo "<pre>";
print_r($planning);
echo "</pre>";
//*/

	}
	else if($action == 'getDetailsContenuPlanning'){
		$mats = Matiere::getbyNiveau($niveau);
		//print_r($mats);
		?>

			<select class="matiere">
				<option value="null">matiere</option>
				<?php 
					foreach ($mats as $kmat => $mat) {
						?>
					<option value="<?php  echo $mat['id'];?>">
					<?php 
						if(strlen($mat['nom']) > 18 ){
							echo substr($mat['nom'], 0,18).'.';
						}else{
							echo $mat['nom'];
						}
					 ?>
					</option>
						<?php
					}
				 ?>
			</select><br>


			<select class="professeur">
				<option value="null">Professeur</option>
				<?php 
					foreach (Professeur::getlist() as $kprof => $prof) {
						?>
					<option value="<?php  echo $prof['id'];?>">
					<?php echo $prof['nom']; ?>
					</option>
						<?php
					}
				 ?>
			</select><br>

			<select class="salle">
				<option value="null">Salle</option>
				<?php 
					foreach (Salle::getlist() as $ksale => $salle) {
						?>
					<option value="<?php  echo $salle['id'];?>">
					<?php echo $salle['nom']; ?>
					</option>
						<?php
					}
				 ?>
			</select>

		<?php
	}else if($action == 'saveContentEDT'){
		$cp = new Contenuplanning();
		$cp->jour= $jour;
		$cp->horaire= $horaire;
		$cp->id_planning = 0;
		if( is_numeric($planning))
		$cp->id_planning=$planning;
		$cp->id_professeur=0;
		if(is_numeric($professeur))
		$cp->id_professeur=$professeur;
		$cp->id_matiere=$matiere;
		$cp->id_salle = 0;
		if(is_numeric($salle))
		$cp->id_salle=$salle;

		/*
		echo "<pre>";
		print_r($cp);
		echo "</pre>";
		//*/
		$cp->create();
		echo $cp->id;

	}
}