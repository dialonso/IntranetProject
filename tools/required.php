<?php  
session_start();
$root = $_SERVER['DOCUMENT_ROOT'].'/pfe/';
require_once($root.'model/compte.class.php');
require_once($root.'model/etudiant.class.php');
require_once($root.'model/role.class.php');
require_once($root.'model/membre_administration.class.php');
require_once($root.'model/groupe.class.php');
require_once($root.'model/filiere.class.php');
require_once($root.'model/classe.class.php');
require_once($root.'model/niveau.class.php');
require_once($root.'model/absences.class.php');
require_once($root.'model/retards.class.php');
require_once($root.'model/parent_etudiant.class.php');
require_once($root.'model/support_numerique.class.php');
require_once($root.'model/notes.class.php');
require_once($root.'model/paiement.class.php');
require_once($root.'model/planning.class.php');
require_once($root.'model/professeur.class.php');
require_once($root.'model/evaluation.class.php');
require_once($root.'model/matiere.class.php');
require_once($root.'model/salle.class.php');
require_once($root.'model/contenu_planning.class.php');

