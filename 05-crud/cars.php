<?php

header('Content-Type: application/json');

// Se connecter à la BDD
$db = new PDO('mysql:host=localhost;dbname=api_cars', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = $db->prepare('SELECT * FROM cars WHERE id = :id');
    $query->execute(['id' => $id]);
    $car = $query->fetch();

    echo json_encode($car);
} else {
    // Récupérer la liste des voitures
    $cars = $db->query('SELECT * FROM cars')->fetchAll();

    // Renvoyer la liste des voitures en JSON
    echo json_encode($cars);
}
