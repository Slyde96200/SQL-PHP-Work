<!DOCTYPE html>
<html>
<head>
    <title>Ajout de rdv</title>
</head>
<body>
    <h1>Ajout de rdv</h1>
    <form action="ajout-rendezvous.php" method="post">

   
    <select name="Rendez-vous">
      <option value="onaccount">J'ai déja un compte patient
       
        
      </option>
      <option value="offaccount">Je n'ai pas de compte patient</option><br>
      <input type="text" id="idPatients" name="idPatients" required> Votre identifiant 
    </select>



        <br><label for="dateHour">Date de RDV souhaité :</label>
        <input type="date" id="dateHour" name="dateHour" required>
        <br>
        <br>
        <input type="submit" value="je confirme mon rdv">
        <br>
        
    </form>
</body>
</html>
<?php

use PDO;
// Récupération des données saisies dans le formulaire
$dateHour = $_POST['dateHour'];
$idPatients = $_POST['idPatients'];





// Connexion à la base de données
$dsn = "mysql:host=localhost;dbname=hospitale2n;charset=utf8";
$user = "root";
$pass = "";

try {
    $dbh = new PDO($dsn, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Préparation de la requête SQL d'insertion
    $stmt = $dbh->prepare("INSERT INTO appointments (dateHour,idPatients) VALUES (:dateHour, :idPatients)");
    $stmt->bindParam(':dateHour', $dateHour);
    $stmt->bindParam(':idPatients', $idPatients);

    $stmt->execute();
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}