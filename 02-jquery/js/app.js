// Requête AJAX avec jQuery
$.get('./worker.php').done(function (data) {
    $('#title').html(data);
});

// Clique sur le bouton
$('#changeSentence').click(function () {
    $.ajax({
        type: 'GET',
        url: './worker.php'
    }).done(function (data) {
        // On met à jour le h1 avec la nouvelle phrase
        $('#title').html(data);
    }).fail(function (xhr) {
        console.log('Erreur de réseau');
    });
});
