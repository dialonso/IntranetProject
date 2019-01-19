<?php
	require_once('eleve.class.php');
	require_once('etudiant.class.php');
	// require_once('etudiant.class.php');
/*
	$mesEleves = eleve::getList();

	echo('<pre>');
		print_r($mesEleves);
	echo('</pre>');

	$monEleve = new eleve();
	$monEleve->firstName = 'SALMON';
	$monEleve->lastName = 'Jeremy';
	$monEleve->birthDate = '1979-06-01';
	$monEleve->matricule = '1234ABC';
	$saved = $monEleve->save();
	if($saved === true)
		echo("Eleve cree avec succes");
	else
		echo("Erreur lors de la creation");

	$monEleve = eleve::getById(1);
	echo('<pre>');
		print_r($monEleve);
	echo('</pre>');
//*/
/*
	$etudiant = new Etudiant("Lesly ",'Conda and BOBO',"0052Ol8dsd4545459");
	$etudiant->mail ="L.C.B@gmail.com";
	$etudiant->gsm = "(+212) 64578 9632";
	$etudiant->date_naissance = "2012-02-12";
	//$etudiant->create();
	//*/
	$etudiant= Etudiant::getById(1);
	
	echo('<pre>');
		print_r(Etudiant::makeObjEtudiant($etudiant));
	echo('</pre>');
	