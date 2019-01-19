<?php
	define('DB_SERVER','localhost');
	define('DB_USER','root');
	define('DB_PASSWORD','');
	define('DB_DB','pfe');

	function dbConnect(){
		/*
		$id = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD);
		if($id === false)
			return false;

		mysql_select_db(DB_DB);
		return $id;
		//*/

		$bdd = null;
		try{
				$bdd = new PDO('mysql:host='.DB_SERVER.';dbname='.DB_DB,DB_USER,DB_PASSWORD);
		}catch(Exception $e){
				die('Error : '.$e->getMessage());
		}
		return $bdd;
	}

	function dbDisconnect($id){
		mysql_close($id);
	}
