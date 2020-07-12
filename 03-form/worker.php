<?php
// En tête pour configurer le rendu en JSON
header('Content-Type: application/json');

sleep(2);

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
   'XMLHttpRequest' === $_SERVER['HTTP_X_REQUESTED_WITH']) {

    if ('POST' === $_SERVER['REQUEST_METHOD']) {
        $name = $_POST['name'];
        $message = $_POST['message'];

        $data = [
            'name' => $name,
            'message' => $message
        ];

        // Je renvoie du json plutôt qu'un tableau PHP
        echo json_encode($data);
    }

}
