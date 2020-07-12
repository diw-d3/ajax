<?php

require_once __DIR__ . '/config/dbconnect.php';

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Villes</title>
</head>
<body>
    <h2>Afficher la liste des départements :</h2>

    <select name="departement" id="departement">
        <option value="">Choisir votre département</option>
        <?php
            $q = $db->query('SELECT * FROM departement');
            $departements = $q->fetchAll(PDO::FETCH_OBJ);

            foreach ($departements as $departement) {
                echo "<option value=\"$departement->departement_code\">$departement->departement_nom</option>";
            }
        ?>
    </select>

    <h2>Afficher la liste des villes du Nord :</h2>
    <ul id="cities"></ul>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        $('#departement').on('change', function () {
            // On récupére le département choisi
            var departement = $(this).val();
            // On va supprimer les villes existantes
            $('#cities').empty();
            // On récupére les villes du département en AJAX
            $.get('./worker.php?id='+departement).done(function (cities) {
                // On parcourt toutes les villes pour les afficher
                // dans le DOM
                for (city of cities) {
                    var li = $('<li></li>');
                    li.html(city.ville_nom_reel);
                    // On crée un attribut data-population dans le HTML où on stocke le contenu de la colonne
                    // ville_population_2012 de la table villes_france_free
                    li.attr('data-population', city.ville_population_2012);
                    $('#cities').append(li);
                }

                // On écoute le click sur une ville
                $('#cities li').on('click', function (event) {
                    var city = $(this).text();
                    // On récupére la population dans le li
                    var population = $(this).data('population'); // ou $(this).attr('data-population');
                    alert(city + ' posséde ' + population + ' habitants.');
                });
            });
        });        
    </script>
</body>
</html>
