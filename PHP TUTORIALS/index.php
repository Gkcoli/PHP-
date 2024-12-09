<?php

$host = 'localhost';
$db   = 'colinares';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';


	try {
		// Set DSN (Data Source Name)
		$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
		
		// Options for PDO
		$options = [
			PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Enables exceptions for errors
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Fetches results as associative arrays
			PDO::ATTR_EMULATE_PREPARES   => false,                  // Disables emulated prepared statements
		];
		
		// Create a PDO instance
		$pdo = new PDO($dsn, $user, $pass, $options);
		$asdsadsa = 1;
		
		echo "Connected";
		
	} catch (PDOException $e) {
		// Handle connection errors
		echo "Connection failed: " . $e->getMessage();
		$asdsadsa = 0;
	}

	if($asdsadsa == 1 && isset($_POST['LastName']))
	{ 
		$ln = $_POST['LastName'];
		$fn = $_POST['FirstName'];
		$mn = $_POST['MiddleName'];
		echo "$ln, $fn, $mn";
		$sql = "INSERT INTO personaldata (LastName, FirstName, MiddleName) VALUES (:ln, :fn, :mn)";
		$stmt =$pdo->prepare($sql);
		$stmt->execute(['ln' => $ln, 'fn' => $fn, => 'mn' => $mn]);
		echo "<br>Data inserted succesfully!";
		$sql = "SELECT id, FirstName, MiddleName, LastName 
		FROM personaldata";
		$stmt = $pdo->query($sql);
		$rows = $stmt->fetchAll();

		foreach ($rows as $row):
			echo $row['FirstName']."<br>";
			echo $row['MiddleName']."<br>"
			echo $row['LastName']."<br>";
			echo $row['ID']."<hr>";
		endforeach


	}
	

?>
<table>
        <tr>
            <td>
                <form action = "" method="POST">
                LastName<br>
                <input type="text" name="LastName" required autofocus><br><br>
                FirstName<br>
                <input type="text" name="FirstName"><br><br>
                MiddleName<br>
                <input type="text" name="MiddleName"><br><br>
                <input type="submit">
                </form>
            </td>
            </td></td>
        </tr>
        
</table>                
                
	




