<?php

/* connexion a la BD */
include '00_index.php'; 

echo 'Exercice 6';
echo "<h1>Voici tous les spectacles avec le titre, le nom de l'artiste, la date et l'heure:</h1><br/>";

$query = "SELECT * FROM shows ORDER BY performer ASC";

// tentative de connexion et de récupération de la requete dans la base

try {
    $results = $database->query($query);
} catch (PDOException $e) {
    die("ERROR : " . $e->getMessage() . "<br />");
}

// conversion des données récupérées en un tableau + affichage 

$data = $results->fetchAll(PDO::FETCH_ASSOC);
foreach ($data as $array) {
    echo "<h5>" . $array["title"] . "<br></h5>";
    echo "<h2>" . $array["performer"] . "<br></h2>";
    echo "<h5>" . $array["date"] . "<br></h5>";
    echo "<h5>" . $array["startTime"] . "<br></h5>";
    echo '<br/><br/>';
}

?>