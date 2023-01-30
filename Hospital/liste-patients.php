<?php
use PDO;

$pdo = new PDO("mysql:host=localhost;dbname=hospitale2n", "root", "");
$per_page = 1;
$page = 1;

if (isset($_GET["page"]) && is_numeric($_GET["page"])) {
    $page = (int)$_GET["page"];
}

$start_from = ($page-1) * $per_page;
$query = $pdo->prepare("SELECT * FROM patients LIMIT ?, ?");
$query->bindValue(1, $start_from, PDO::PARAM_INT);
$query->bindValue(2, $per_page, PDO::PARAM_INT);
$query->execute();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des Patients</title>
</head>
<body>
    <h1>Liste des Patients</h1>
    <a href="ajoutpatient.php">Ajouter un Patient</a><br>
    <br><a href="profil-patient.php">profil patient</a>
    <br><br>
    <table>
        <tr>
            <th>ID</th>
            <th>Prénom</th>
            <th>Nom</th>
<!--             <th>Date de naissance</th>
            <th>Adresse</th>
            <th>Téléphone</th> -->
        </tr>
        <?php
        while ($row = $query->fetch()) {
            echo "<tr>";
            echo '<td><a href="profil-patient.php?id='.$row['id'].'">'.$row['id'].'</a></a></td>';
            echo "<td>" . $row["firstname"] . "</td>";
            echo "<td>" . $row["lastname"] . "</td>";
/*             echo "<td>" . $row["birthdate"] . "</td>";
            echo "<td>" . $row["mail"] . "</td>";
            echo "<td>" . $row["phone"] . "</td>";
            echo "</tr>"; */
        }
        ?>
    </table>
    <?php
    $query = $pdo->query("SELECT COUNT(id) FROM patients");
    $row = $query->fetch();
    $total_records = $row[0];
    $total_pages = ceil($total_records / $per_page);
    for ($i=1; $i<=$total_pages; $i++) {
        echo '<a href="liste-patients.php?page='.$i.'">'.$i.'</a>';
    }
    ?>
</body>
</html>