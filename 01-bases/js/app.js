// On instancie le navigateur AJAX
var xhr = new XMLHttpRequest();

// On va suivre l'évolution de la requête AJAX
xhr.addEventListener('readystatechange', function () {
    if (4 === xhr.readyState) {
        var title = xhr.response;
        console.log(title);
        document.getElementById('title').textContent = title;
    }
});

// On saisit la requête HTTP
xhr.open('GET', './worker.php');

// On exécute la requête HTTP
xhr.send();

// On clique sur le bouton pour changer la phrase
document.getElementById('changeSentence').addEventListener('click', function () {
    // Faire la requête
    xhr.open('GET', './worker.php');
    xhr.send();
});

alert('toto');
