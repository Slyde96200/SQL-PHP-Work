<?php

use PDO;
?>
<!DOCTYPE html>
<html>

<head>
    <title>Liste des rendez-vous</title>
</head>

<body>
    <h1>Liste des rendez- vous</h1>
    <a href="ajout-rendezvous.php">Ajouter un rendez-vous</a>
    <br><br>
    <table>
        <tr>
            <th>id rdv </th>
            <th> Date de rendezvous
            <th> ID patient</th>

        </tr>
        <?php
        $pdo = new PDO("mysql:host=localhost;dbname=hospitale2n", "root", "");
        $query = $pdo->prepare("SELECT * FROM appointments");
        $query->execute();
        $result = $query->fetchAll();
        foreach ($result as $row) {
            echo "<tr>";
            echo '<td><a href="rendezvous.php?id=' . $row['id'] . '">' . $row['id'] . '</a></a></td>';
            echo "<td>" . $row["dateHour"] . "</td>";
            echo "<td>" . $row["idPatients"] . "</td>";

            echo "</tr>";
        }
        ?>
    </table>
</body>

</html>

</table>
<?php
if (isset($_GET['id']) ) {
    $query2 = $pdo->prepare("SELECT * FROM appointments WHERE id=". $_GET['id']);
        $query2->execute();
        $result2 = $query2->fetchAll();


?>
    <form method="post" action="rendezvous.php?id=<?php echo $_GET['id']; ?>">
        <label for="dateHour">date rdv : </label>
        <input type="date" id="dateHour" name="dateHour" value='<?php echo $result[0]["dateHour"]; ?>'>
        <br>
        <input type="submit" name="modif" value="Modifier">
        <input type="submit" name="supr" value="Supprimer">
    </form>
<?php
}
?>
</body>

</html>
<?php
if (isset($_POST["modif"])) {

    $sql = "UPDATE appointments SET dateHour = :dateHour WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue('dateHour', $_POST['dateHour']);
    $stmt->bindValue('id', $_GET['id']);
    $stmt->execute();
}
if (isset($_POST["supr"])) {

    $sql = "DELETE FROM appointments WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue('id', $_GET['id']);
    $stmt->execute();
}