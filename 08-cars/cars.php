<?php

// En tête pour renvoyer du json
header('Content-Type: application/json');

// Connexion à la base de données
$db = new PDO('mysql:host=localhost;dbname=cars;charset=utf8', 'root', '', [
    // Permet d'afficher les erreurs SQL
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
]);

// Si id est présent dans $_GET, on affiche une seule voiture
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = $db->prepare('SELECT * FROM cars WHERE id = :id');
    $query->bindValue(':id', $id);
    $query->execute();
    $car = $query->fetch();
    echo json_encode($car); // On renvoie un objet JSON
} else { // Sinon on affiche toutes les voitures
    // Récupération des voitures de la base de données
    $query = $db->query('SELECT * FROM cars');
    $cars = $query->fetchAll(PDO::FETCH_OBJ);

    // Affichage des voitures en JSON
    echo json_encode($cars);
}