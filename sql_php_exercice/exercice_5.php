<?php

/* connexion a la BD */
include '00_index.php'; 

echo 'Exercice 5';
echo '<h1>Voici tous les clients dont le nom commence par la lettre "M":</h1><br/>';

$query = "SELECT lastName, firstName FROM clients WHERE lastName LIKE 'M%' ORDER BY lastName ASC";
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
    echo "<h5>" . $array["lastName"] . "</h5>";
    echo "<h5>" . $array["firstName"] . "</h5>";
    echo '<br/><br/>';
}



?>