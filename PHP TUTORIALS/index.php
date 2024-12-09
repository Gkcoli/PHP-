<?php
$host = 'localhost'; // Hostname or IP address
$db = 'coli'; // Database name
$user = 'root'; // MySQL username
$pass = ''; // MySQL password
$charset = 'utf8mb4'; // Character set (optional but recommended)

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
    $connectionStatus = 1;
    echo "Connected successfully.<br>";
} catch (PDOException $e) {
    // Handle connection errors
    echo "Connection failed: " . $e->getMessage();
    $connectionStatus = 0;
}

// Initialize variables
$ln = $fn = $mn = "";

// Insert or update data
if ($connectionStatus == 1 && isset($_POST['lastname'])) {
    $ln = $_POST['lastname'];
    $fn = $_POST['firstname'];
    $mn = $_POST['middlename'];

    echo "$ln, $fn $mn<br>";

    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $sql = "UPDATE personaldata SET lastname = :ln, firstname = :fn, middlename = :mn WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['ln' => $ln, 'fn' => $fn, 'mn' => $mn, 'id' => $id]);

        echo "Data updated successfully!<br>";
    } else {
        $sql = "INSERT INTO personaldata (lastname, firstname, middlename) VALUES (:ln, :fn, :mn)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['ln' => $ln, 'fn' => $fn, 'mn' => $mn]);

        echo "Data inserted successfully!<br>";
    }
}

// Delete data
if (isset($_GET['code'])) {
    $code = $_GET['code'];
    $sql = "DELETE FROM personaldata WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $code]);

    echo "Data deleted successfully!<br>";
}

// Fetch all records
$sql = "SELECT id, firstname, middlename, lastname FROM personaldata";
$stmt = $pdo->query($sql);
$result = $stmt->fetchAll();

foreach ($result as $row) {
    echo $row['firstname'] . "<br>";
    echo $row['middlename'] . "<br>";
    echo $row['lastname'] . "<br>";

    echo "<a href='?edit={$row['id']}'>Edit</a> | ";
    echo "<a href='?code={$row['id']}'>Delete</a><br><br>";
}

// Fetch record for editing
if (isset($_GET['edit'])) {
    $ed = $_GET['edit'];
    $sql = "SELECT id, firstname, middlename, lastname FROM personaldata WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $ed]);
    $rows1 = $stmt->fetchAll();

    foreach ($rows1 as $row2) {
        $ln = $row2['lastname'];
        $fn = $row2['firstname'];
        $mn = $row2['middlename'];
    }
}
?>

<table>
    <tr>
        <td>
            <form action="" method="POST">
                Last Name<br>
                <input value="<?php echo htmlspecialchars($ln); ?>" type="text" name="lastname" required><br><br>
                First Name<br>
                <input value="<?php echo htmlspecialchars($fn); ?>" type="text" name="firstname" required><br><br>
                Middle Name<br>
                <input value="<?php echo htmlspecialchars($mn); ?>" type="text" name="middlename" required><br><br>
                <input type="submit" value="Submit">
                <a href="index.php">New</a>
            </form>
        </td>
        <td></td>
    </tr>
</table>
