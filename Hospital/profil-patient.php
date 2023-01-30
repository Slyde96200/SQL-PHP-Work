
<!DOCTYPE html>
<html>

<head>
    <title>profil patient</title>
</head>

<body>
    <h1>profil patient</h1>
    <a href="ajoutpatient.php">Ajouter un Patient</a>
    <br><br>
    <table>
        <tr>
            <th>ID</th>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Date de naissance</th>
            <th>Adresse</th>
            <th>Téléphone</th>
        </tr>
        <?php
        $pdo = new PDO("mysql:host=localhost;dbname=hospitale2n;charset=utf8", "root", "");
        $query = $pdo->prepare("SELECT * FROM patients WHERE id = " . $_GET['id']);
        $query->execute();
        $result = $query->fetchAll();
      
        foreach ($result as $row) {

            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["firstname"] . "</td>";
            echo "<td>" . $row["lastname"] . "</td>";
            echo "<td>" . $row["birthdate"] . "</td>";
            echo "<td>" . $row["mail"] . "</td>";
            echo "<td>" . $row["phone"] . "</td>";
            echo "</tr>";
        }
        ?>
        <form method="post" action="profil-patient.php?id=<?php echo $result[0]['id']; ?>">
            <label for="name">Nom : </label>
            <input type="text" id="lastname" name="lastname" value='<?php echo $result[0]['lastname']; ?>'>
            <br>
            <label for="firstname">Prénom : </label>
            <input type="text" id="firstname" name="firstname" value='<?php echo $result[0]['firstname']; ?>'>
            <br>
            <label for="birthdate">Date de naissance : </label>
            <input type="text" id="birthdate" name="birthdate" value='<?php echo $result[0]['birthdate']; ?>'>
            <br>
            <label for="mail">Adresse mail : </label>
            <input type="text" id="mail" name="mail" value='<?php echo $result[0]['mail']; ?>'>
            <br>
            <input type="submit" name="modif" value="Modifier">
            <input type="submit" name="supr" value="Suprrimer">
            <input type="submit" name="voirplus" value="Voir les rdv du patient">
        </form>
    </table>
</body>

</html>
<?php
if (isset($_POST["modif"])) {

    $sql = "UPDATE patients SET lastname = :lastname, firstname = :firstname, birthdate = :birthdate, mail = :mail WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue('lastname', $_POST['lastname']);
    $stmt->bindValue('firstname', $_POST['firstname']);
    $stmt->bindValue('birthdate', $_POST['birthdate']);
    $stmt->bindValue('mail', $_POST['mail']);
    $stmt->bindValue('id', $_GET['id']);
    $stmt->execute();
}

if (isset($_POST["supr"])) {

    $sql = "DELETE FROM patients WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue('id', $_GET['id']);
    $stmt->execute();
}

 if (isset($_POST['voirplus'])) { ?>
    
    
    <table>
       
        <tr>
            <?php
        foreach ($result as $row) {
            $query2 = $pdo->prepare("SELECT * FROM appointments WHERE id=". $_GET['id']);
            $query2->execute();
            $result2 = $query2->fetchAll();
            echo "<tr>";
            echo '<td><a href="rendezvous.php?id=' . $row['id'] . '">' . $row['id'] . '</a></a></td>';
            echo "<td>" . $row["dateHour"] . "</td>";
            echo "<td>" . $row["idPatients"] . "</td>";

            echo "</tr>";
        }
        ?>
            

        </tr>
    </table> 

    <form method="post" action="rendezvous.php?id=<?php echo $_GET['id']; ?>">
        <label for="dateHour">date rdv : </label>
        <input type="date" id="dateHour" name="dateHour" value='<?php echo $result[0]["dateHour"]; ?>'>
        <br>
        <input type="submit" name="modif" value="Modifier">
        <input type="submit" name="supr" value="Supprimer">
        
    </form>
<?php
}
if(isset($_POST['lastname'])){
    try{
      $pdo = new PDO("mysql:host=localhost;dbname=hospitale2n;charset=utf8", "root", "");
      $stmt = $pdo->prepare("SELECT * FROM patients WHERE lastname = :lastname");
      $stmt->execute(array(':lastname' => $_POST['lastname']));
      $result2 = $stmt->fetchAll();
      if(count($result2) > 0){
        echo "<table>";
        echo "<tr><th>ID</th><th>Nom</th><th>Prénom</th><th>Profil</th></tr>";
        foreach($result2 as $row){
          echo "<tr>";
          echo "<td>".$row['id']."</td>";
          echo "<td>".$row['lastname']."</td>";
          echo "<td>".$row['firstname']."</td>";
          echo "<td><a href='patient_profile.php?id=".$row['lastName']."'>Profil</a></td>";
          echo "</tr>";
        }
        echo "</table>";
      }else{
        echo "Aucun résultat trouvé.";
      }
    }catch(PDOException $e){
      echo "Erreur : ".$e->getMessage();
    }
  }
?>

<form action="profil-patient.php" method="post">
  <input type="text" name="lastname">
  <input type="submit" value="Rechercher">
</form>

