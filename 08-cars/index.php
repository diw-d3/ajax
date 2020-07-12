<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cars API</title>
</head>
<body>
    <ul id="cars"></ul>
    <div id="car"></div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        $.get('./cars.php').done(function (cars) {
            for (car of cars) {
                var li = $('<li></li>');
                li.html(car.brand);
                li.attr('data-id', car.id);
                $('#cars').append(li);
            }

            $('#cars li').on('click', function () {
                var id = $(this).data('id'); // $(this).attr('data-id');
                // On doit récupérer les informations d'une voiture
                $.get('./cars.php?id='+id).done(function (car) {
                    $('#car').html(car.brand + car.model + car.price);
                });
            });
        });
    </script>
</body>
</html>
