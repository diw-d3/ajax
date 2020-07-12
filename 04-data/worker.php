<?php

// Vérifier que la requête est en POST
if (!empty($_POST) && isset($_POST['sentence'])) {
    $sentence = $_POST['sentence'] ?? 'Pas de phrase';
    var_dump($_POST);
    echo strtoupper($sentence);
}

// Vérifier que la requête est pour le form
if (!empty($_POST) && isset($_POST['name'])) {
    // On renvoie du json côté serveur
    header('Content-Type: application/json');

    $name = $_POST['name'];
    $message = $_POST['message'];
    $errors = [];

    sleep(1);

    // Vérification des erreurs
    if (empty($name)) {
        $errors[] = [
            'name' => 'Le nom est vide'
        ];
    }

    $data = [
        'name' => $name,
        'message' => $message,
        'errors' => $errors
    ];

    echo json_encode($data);
}
