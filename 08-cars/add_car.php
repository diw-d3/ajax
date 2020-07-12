<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cars API</title>
</head>
<body>
    <?php
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
                echo 'Voiture ajoutée.';
            }
        }
    ?>

    <form action="./add_car.php" method="post">
        <label for="brand">Marque</label>
        <input type="text" name="brand" id="brand">
        <label for="model">Modèle</label>
        <input type="text" name="model" id="model">
        <label for="price">Prix</label>
        <input type="text" name="price" id="price">

        <button>Ajouter</button>
    </form>

    <div id="message"></div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        $('form').on('submit', function (event) {
            event.preventDefault(); // On annule le formulaire

            // On soumet le formulaire via une requête AJAX
            $.ajax({
                type: 'POST',
                url: './add_ajax.php',
                data: $(this).serialize(),
                beforeSend: function () {
                    $('#message').html('Chargement en cours...');
                }
            }).done(function (response) {
                $('#message').html(response.success);
            });
        });
    </script>
</body>
</html>
