<?php

/* connexion a la BD */
include '00_index.php'; 

echo 'Exercice 4';
echo '<h1>Voici tous les clients ne possédant pas de carte :</h1><br/>';

$query = "SELECT firstName FROM clients WHERE card = 0 ORDER BY card ASC";
try
{
    $results = $database->query($query);
}
catch(Exception $e)
{
    die('Erreur : ' . $e->getMessage() . '<br/>');
}

$data = $results->fetchAll(PDO::FETCH_ASSOC);
foreach ($data as $array) {
    echo "<h5>" . $array["firstName"] . "</h5>";
}

?>