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

	$phyid = $_POST['PhysicalApp'];
	$roleid = $_POST['Role'];
		
		
	if(!($stmt = $mysqli->prepare("SELECT c.name, health, mana, myid, pid, enemyid, p.name, r.name FROM 275Character c INNER JOIN 275CharRole cr ON c.id = cr.cid INNER JOIN 275Role r ON cr.rid = r.id INNER JOIN 275PhysicalApp p ON p.id = c.pid WHERE p.id ='$phyid' AND r.id ='$roleid' ORDER BY c.name"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!$stmt->execute()){
		echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	if(!$stmt->bind_result($out_name, $out_health, $out_mana, $out_myid, $out_pid, $out_enemyid, $out_phy, $out_role)){
		echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	
	echo "Character Table";
	echo "<table border=1px>";
	echo "<tr><td>Name</td><td>Health</td><td>Mana</td><td>Mythology ID</td><td>Physical Appearance ID</td><td>Enemy ID(from Character table)</td><td>Physical Appearance</td><td>Role</td></tr>";
	while($stmt->fetch()){
		echo "<tr><td>";
		echo htmlspecialchars($out_name);
		echo "</td><td>";
		echo htmlspecialchars($out_health);
		echo "</td><td>";
		echo htmlspecialchars($out_mana);
		echo "</td><td>";
		echo htmlspecialchars($out_myid);
		echo "</td><td>";
		echo htmlspecialchars($out_pid);
		echo "</td><td>";
		echo htmlspecialchars($out_enemyid); 
		echo "</td><td>";
		echo htmlspecialchars($out_phy);
		echo "</td><td>";
		echo htmlspecialchars($out_role);
		echo "</td></tr>";
	}
	echo "</table>";
	$stmt->close();

	echo( '<a href="http://web.engr.oregonstate.edu/~leey2/275/smite.php">Click Me to Go Back</a>' );
?>	