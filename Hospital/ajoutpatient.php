<!DOCTYPE html>
<html>
<head>
    <title>Ajout de Patient</title>
</head>
<body>
    <h1>Ajout de Patient</h1>
    <form action="ajoutpatient.php" method="post">
        <label for="firstname">Prénom :</label>
        <input type="text" id="firstname" name="firstname" required>
        <br>
        <label for="lastname">Nom :</label>
        <input type="text" id="lastname" name="lastname" required>
        <br>
        <label for="birthdate">Date de naissance :</label>
        <input type="date" id="birthdate" name="birthdate" required>
        <br>
        <label for="mail">Adresse e-mail :</label>
        <input type="text" id="mail" name="mail" required>
        <br>
        <label for="phone">Téléphone :</label>
        <input type="tel" id="phone" name="phone" required>
        <br>
        <input type="submit" value="Ajouter Patient">
        
    </form>
</body>
</html>
<?php

use PDO;
// Récupération des données saisies dans le formulaire
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];

$mail = $_POST['mail'];
$birthdate = $_POST['birthdate'];
$phone = $_POST['phone'];





// Connexion à la base de données
$dsn = "mysql:host=localhost;dbname=hospitale2n;charset=utf8";
$user = "root";
$pass = "";

try {
    $dbh = new PDO($dsn, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Préparation de la requête SQL d'insertion
    $stmt = $dbh->prepare("INSERT INTO patients (firstname, lastname, phone, mail, birthdate) VALUES (:firstname, :lastname, :phone, :mail, :birthdate)");
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':mail', $mail);
    $stmt->bindParam(':birthdate', $birthdate);
    

    // Exécution de la requête
    $stmt->execute();
} catch (PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}