<?php

// En tête pour renvoyer du json
header('Content-Type: application/json');

sleep(2);

if ('POST' === $_SERVER['REQUEST_METHOD']) {
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $price = $_POST['price'];

    // Connexion à la base de données
    $db = new PDO('mysql:host=localhost;dbname=cars;charset=utf8', 'root', '', [
        // Permet d'afficher les erreurs SQL
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
    ]);

    // On prépare la requête pour ajouter la voiture en base de données
    $query = $db->prepare('INSERT INTO cars(brand, model, price) VALUES(:brand, :model, :price)');
    $query->bindValue(':brand', $brand);
    $query->bindValue(':model', $model);
    $query->bindValue(':price', $price);
    
    if ($query->execute()) {
        echo json_encode(['success' => 'Voiture ajoutée']);
    }
}