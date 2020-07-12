// Faire la requête AJAX sur cars.php
// Après la requête, on doit afficher les résultats sous forme de liste
// Marque modèle : X euros
$.get('./cars.php').done(function (cars) {
    console.log(cars);

    for (key in cars) {
        var car = cars[key];
        var li = $('<li data-car="'+car.id+'">'+car.brand+' '+car.model+' : '+car.price+' euros</li>');

        $('ul').append(li);
    }
});

// Au clic sur un li
$('body').on('click', 'li', function () {
    var id = $(this).attr('data-car');
    $.get('./cars.php?id='+id).done(function (car) {
        console.log(car);
    });
});
