<?php
header('Content-Type: application/json');

require_once __DIR__ . '/config/dbconnect.php';

$q = $db->query('SELECT * FROM villes_france_free WHERE ville_departement = '.$_GET['id']);
$villes = $q->fetchAll(PDO::FETCH_OBJ);

echo json_encode($villes);

/*foreach ($villes as $ville) {
    echo $ville->ville_nom_reel . '<br />';
}*/
