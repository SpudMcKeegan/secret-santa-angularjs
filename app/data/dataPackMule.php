<?php
	/*
		Creator: Kyle J Keegan (fauxkeegan, spudMcKeegan)

		This file is where all of the ajax calls are directed. This will deliver the data to the front end.
	*/

	GLOBAL $listTable, $participantTable;
	$listTable = 'secretsantalist';
	$participantTable = 'participants';

	if(isset($_GET)){
		echo json_encode($_GET['method'](@$_GET));
	}

	function queryDatabaseGet($query){
		//Set up base vars
		$records = array();
		$mysqli = new mysqli('localhost', 'root', '', 'test');

		//Test Connection
		if ($mysqli->connect_error) { die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error); }

		//Query and force into array, unless the array has one index, then set it to a string;
		$query = mysqli_query($mysqli, $query);
		while($row = $query->fetch_assoc()){ array_push($records, $row); }

		//Close connection
		$mysqli->close();

		//Return the data
		return $records;
	}

	function queryDatabasePost($query){
		$mysqli = new mysqli('localhost', 'root', '', 'test');

		if ($mysqli->connect_error) { die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error); }

		$query = mysqli_query($mysqli, $query);

		$mysqli->close();
	}

	function getAllLists(){
		GLOBAL $listTable;
		
		$query = "SELECT
						ss.id,
						ss.name as sslName,
					    ss.users,
					    p.name as creatorName
					FROM 
						`secretsantalist` as ss
					JOIN
						`participants` as p
					on
						p.ssList = ss.id
					WHERE
						p.owner = 1;";
		$allRecords = queryDatabaseGet($query);

		return $allRecords;
	}

	function getSpecificList($get){
		GLOBAL $listTable;
		
		$id = $get['id'];

		$query = "SELECT 
					ss.id, 
					ss.name sslName, 
					ss.users, 
					ss.createdDate,
					p.name as creatorName
				FROM 
					$listTable AS ss
				JOIN
					`participants` AS p
				ON
					ss.id = p.ssList
				WHERE 
					ss.id = $id";
		$list = queryDatabaseGet($query)[0];

		return $list;
	}

	function createList($post){
		GLOBAL $listTable;

		$listName = $post['name'];
		$creatorName = $post['creator'];
		$creatorEmail = $post['creatorEmail'];
		$code = $post['code'];

		$query = "INSERT INTO `secretsantalist`(
						`id`, 
						`name`,  
						`code`, 
						`users`, 
						`createdDate`
					) VALUES (
						NULL, 
						'$listName', 
						'$code',
						1,
						CURRENT_TIMESTAMP
					)";
		queryDatabasePost($query);

		$query = "INSERT INTO `participants`(
						`id`, 
						`name`, 
						`email`,
						`ssList`, 
						`owner`, 
						`joinedDate`
					) VALUES (
						NULL, 
						'$creatorName', 
						'$creatorEmail',
						(
							SELECT 
								id 
							FROM secretsantalist 
							WHERE 
								name = '$listName' 
								AND 
								code = '$code'
						), 
						1, 
						CURRENT_TIMESTAMP
					)";
		queryDatabasePost($query);
	}

	function checkCode($get){
		$sucess = '';
		$id = $get['id'];
		$userCode = $get['userCode'];

		$query = "SELECT code FROM secretsantalist WHERE id = $id";

		$listCode = queryDatabaseGet($query)[0]['code'];

		if($userCode == $listCode){
			$success = array('success' => true);
		}else{
			$success = array('success' => false);
		}

		return $success;
	}

	function joinList($get){
		$ssListId = $get['id'];
		$userName = $get['userName'];
		$userEmail = $get['userEmail'];

		$query = "INSERT INTO `participants`
		(
			`id`, 
			`name`, 
			`email`, 
			`ssList`, 
			`owner`, 
			`joinedDate`
		) VALUES (
			NULL, 
			'$userName',
			'$userEmail',
			'$ssListId',
			'0',
			CURRENT_TIMESTAMP
		)";
		queryDatabasePost($query);

		$query = "UPDATE `secretsantalist` SET users = users + 1 WHERE `secretsantalist`.`id` = $ssListId";
		queryDatabasePost($query);
	}

	function checkOwner($get){
		$userName = $get['userName'];
		$userCode = $get['userCode'];

		$query = "SELECT 
						ss.id 
					FROM 
						`secretsantalist` as ss 
					JOIN 
						`participants` as p 
					ON 
						p.ssList = ss.id
					WHERE 
						p.name = '$userName'
					AND
						ss.code = $userCode";

		$queryResults = queryDatabaseGet($query);

		if(array_key_exists(0,$queryResults)){
			$returnVal = $queryResults[0];
		}else{
			$returnVal = array('id' => 'null');
		}

		return $returnVal;
	}

	function getFullListing($get){
		$id = $get['listingId'];

		$query = "SELECT * FROM secretsantalist WHERE id = $id";
		$secretsantalist = queryDatabaseGet($query)[0];

		$query = "SELECT * FROM participants WHERE ssList = $id";
		$users = queryDatabaseGet($query);

		$secretsantalist['users'] = $users;

		return $secretsantalist;
	}

	function removeUser($post){
		$userid = $post['id'];

		$query = "DELETE FROM participants WHERE id = $userid";
		queryDatabasePost($query);
	}

	function toggleOwner($post){
		$ownerid = $post['id'];
		$ownerVal = $post['owner'];

		$query = "UPDATE participants SET owner = $ownerVal WHERE id = $ownerid";
		queryDatabasePost($query);
	}
?>