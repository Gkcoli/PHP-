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

if ($asdsadsa == 1 && isset($_POST['lastname'])) {
        $ln = $_POST['lastname'];
        $fn = $_POST['firstname'];
        $mn = $_POST['middlename'];
 
        echo "$ln, $fn $mn";
       
        $sql = "INSERT INTO personaldata (lastname, firstname, middlename) VALUES (:ln, :fn, :mn)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['ln' => $ln, 'fn' => $fn, 'mn' => $mn]);
 
        echo "<br> Data inserted successfully <br>";
    }
 
    if ((isset($_GET['code'])) && !isset($_POST['lastname'])) {
        $code = $_GET['code'];
        $sql = "DELETE FROM personaldata WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $code]);
        echo "<br> Data deleted successfully!<hr>";
    }
 
    $sql = "SELECT id, firstname, middlename, lastname FROM personaldata";
        $stmt = $pdo->query($sql);
        $result = $stmt->fetchAll();
 
        foreach ($result as $row):
            echo $row['firstname'] . "<br>";
            echo $row['middlename'] . "<br>";
            echo $row['lastname'] . "<br>";
 
           ?><a href='?edit=<?=$row['id']?>'>Edit</a>?php
           ?><a href='?code=<?=$row['id']?>'>Delete</a>?php

        endforeach;
?>
 
<table>
<tr>
    <td>
        <form action="" method="POST">
            Last Name<br>
            <input type="text" name="lastname" required autofocus><br><br>
            First Name<br>
            <input type="text" name="firstname" required><br><br>
            Middle Name<br>
            <input type="text" name="middlename" required><br><br>
            <input type="submit">
        </form>
    </td>
</tr>
</table>
