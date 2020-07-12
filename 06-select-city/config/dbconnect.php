<?php

try {
    $db = new PDO('mysql:host=localhost;dbname=france;charset=utf8', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
    ]);
} catch (Exception $e) {
    echo $e->getMessage();
}
