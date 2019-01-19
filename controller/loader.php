<?php
	$roots = $_SERVER['DOCUMENT_ROOT'].'/pfe/';
	require_once($roots.'tools/required.php');
	
    include_once($roots.'lib/Twig/Autoloader.php');
    Twig_Autoloader::register();
    
    $loader = new Twig_Loader_Filesystem($roots.'templates'); // Dossier contenant les templates
    $twig = new Twig_Environment($loader, array(
      'cache' => false
    ));

    if(!isset($_SESSION['user']))
	header('Location:/pfe/');

