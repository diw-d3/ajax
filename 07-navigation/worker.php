<?php

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
   'XMLHttpRequest' === $_SERVER['HTTP_X_REQUESTED_WITH']) {
    if ('GET' === $_SERVER['REQUEST_METHOD']) {
        // On récupére ./pizzas et on le transforme en /pizzas
        $uri = str_replace('.', '', $_GET['page']);

        if ('/pizzas' === $uri) {
            echo 'Page pizzas';
        } else if ('/burgers' === $uri) {
            echo 'Page burgers';
        }
    }
}
