<?php
	/*
		Creator: Kyle J Keegan (fauxkeegan, spudMcKeegan)

		This file is where all of the ajax calls are directed. This will deliver the data to the front end.
	*/

	GLOBAL $db;

	if(isset($_GET)){
		connectToData();
		echo $_GET['method']();
		//$mysqli->close();
	}

	function connectToData(){
		GLOBAL $db;
		//$db = new mysqli('localhost', 'root', '', 'test');

		try {
		    $db = new PDO("pgsql:dbname=secretSantaList;host=localhost", "root", "" );
		    echo "PDO connection object created";
	    }catch(PDOException $e){
	    	echo $e->getMessage();
	    }

		/*if ($mysqli->connect_error) {
   			die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
		}*/
	}

	function test(){
		GLOBAL $mysqli;
		$records = array();
		$query = "SELECT * FROM secretSantaList";
		
		/*while($results = $mysqli->query($query, MYSQLI_USE_RESULT)){
			var_dump($results);
			array_push($records, $results);
		}*/

		return json_encode($records);
	}

	function untest(){
		$one = 1;

		return json_encode();
	}
?>