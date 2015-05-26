<?php
	/*
		Creator: Kyle J Keegan (fauxkeegan, spudMcKeegan)

		This file is where all of the ajax calls are directed. This will deliver the data to the front end.
	*/

	GLOBAL $listTable;
	$listTable = 'secretsantalist';

	if(isset($_GET)){
		echo json_encode($_GET['method'](@$_GET));
	}

	function queryDatabaseGet($query){
		$mysqli = new mysqli('localhost', 'root', '', 'test');

		if ($mysqli->connect_error) {
   			die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
		}

		$records = array();		
		$query = mysqli_query($mysqli, $query);

		while($row = $query->fetch_assoc()){
			array_push($records, $row);
		}

		$mysqli->close();

		return $records;
	}

	function queryDatabasePost($query){
		$mysqli = new mysqli('localhost', 'root', '', 'test');

		if ($mysqli->connect_error) {
   			die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
		}

		$records = array();		
		$query = mysqli_query($mysqli, $query);

		$mysqli->close();

		return $records;
	}

	function getAllLists(){
		GLOBAL $listTable;
		
		$query = "SELECT * FROM $listTable";
		$allRecords = queryDatabaseGet($query);

		return $allRecords;
	}

	function getSpecificList(){
		GLOBAL $listTable;
		
		$id = @$_GET['id'];
		$query = "SELECT * FROM $listTable WHERE id = $id";
		$list = queryDatabaseGet($query);
		$list = $list[0];

		return $list;
	}

	function createList($post){
		GLOBAL $listTable;

		$name = $post['name'];
		$creator = $post['creator'];
		$code = $post['code'];

		$query = "INSERT INTO `test`.`secretsantalist` (`id`, `name`, `creator`, `code`, `createdDate`) VALUES (NULL, '$name', '$creator', '$code', CURRENT_TIMESTAMP)";

		echo $query;

		queryDatabasePost($query);
	}

	function joinList($get){
		GLOBAL $get;

		return "nothing";
	}
?>