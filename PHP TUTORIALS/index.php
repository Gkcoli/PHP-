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

	if($asdsadsa == 1 && isset($_POST['lastname']))
	{ 
		$ln = $_POST['lastname'];
		$fn = $_POST['firstname'];
		$mn = $_POST['middlename'];
		echo "$ln, $fn, $mn";
	}

?>
<table>
        <tr>
            <td>
                <form action = "" method="POST">
                Last Name<br>
                <input type="text" name="lastname" required autofocus><br><br>
                First Name<br>
                <input type="text" name="firstname"><br><br>
                Middle Name<br>
                <input type="text" name="middlename"><br><br>
                <input type="submit">
                </form>
            </td>
            </td></td>
        </tr>
        
</table>                
                
	




