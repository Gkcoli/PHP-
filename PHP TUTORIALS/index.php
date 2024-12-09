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
 
            ?><a href='?code=<?=$row['id']?>'><?php
            echo $row['id'] . "<br>";?></a><?php
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
