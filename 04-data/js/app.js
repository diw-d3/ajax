// On clique sur le bouton, on envoie la phrase au serveur
$('#sendSentence').click(function () {
    $.ajax({
        type: 'POST',
        url: './worker.php',
        data: { sentence: $('#sentence').val() }
    }).done(function (response) {
        $('#title').html(response);
    });
});

// Traitement du formulaire
$('form').submit(function (event) {
    // Annule le comportement par défaut
    event.preventDefault();

    // Requête AJAX
    $.ajax({
        type: 'POST',
        url: $(this).attr('action'),
        data: $(this).serialize(),
        beforeSend: function () {
            $('h2').remove();
            $('ul').remove();
            $('form').after('<div id="loading">Chargement...</div>');
        },
        complete: function () {
            $('#loading').remove();
        }
    }).done(function (data) {
        // data.errors renvoie un tableau d'erreurs
        // Si le tableau data.errors n'est pas vide,
        // on le parcours, et on affiche chaque erreur
        // dans une liste (ul > li)
        // On affichera la liste au dessus du formulaire
        // S'il n'y a pas d'erreurs, on affiche un 
        // message de succès
        if (data.errors.length > 0) {
            var ul = $('<ul></ul>');
            for (var i = 0; i < data.errors.length; i++) {
                ul.append($('<li>'+data.errors[i]['name']+'</li>'));
            }
            ul.insertBefore('form');
        } else {
            $('<h2>Votre formulaire a été envoyé</h2>').insertBefore('form');
        }
    });
});
