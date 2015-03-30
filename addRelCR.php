<?php
 
	//ini_set('error_reporting', E_ALL);
	//ini_set('display_errors', 'On');  //On or Off	
	
	
	$dbhost = 'oniddb.cws.oregonstate.edu';
	$dbname = 'leey2-db';
	$dbuser = 'leey2-db';
	$dbpass = 'hqldhrvMO9c6xlVr';

	$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname); 

	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") "
		. $mysqli->connect_error;
	exit;
	}
	
	$Characterid = $_POST['Character'];
	$Roleid = $_POST['Role'];

	if (!($stmt = $mysqli->prepare("SELECT cid FROM 275CharRole WHERE cid='$Characterid' AND rid='$Roleid'"))) {
		echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}

	if (!$stmt->execute()) {

	}
	
	if (!$stmt->bind_result($out_id)) {

	}	
	
	if (!$stmt->fetch()) {

	}
	
	//To prevent duplicate entry
	if ($out_id == NULL){
		if (!($stmt = $mysqli->prepare("INSERT INTO 275CharRole(rid, cid) VALUES (?, ?)"))) {
			echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}

		if (!$stmt->bind_param("ii", $Roleid, $Characterid)) {
			echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}

		if (!$stmt->execute()) {
			echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		}
	}
	else{
		echo "That Relationship already exist.";
	}
	$stmt->close();

	echo( '<a href="http://web.engr.oregonstate.edu/~leey2/275/smite.php">Click Me to Go Back</a>' );
?>	