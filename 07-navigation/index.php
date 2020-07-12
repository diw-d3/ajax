<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Navigation en AJAX</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .dark-mode {
            background-color: #222;
            color: #fff;
            cursor: pointer;
            transition: 0.5s;
        }

        .navbar {
            transition: 0.5s;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="./">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./pizzas">Pizzas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./burgers">Burgers</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <span id="switch-mode" class="nav-link">Switch to Dark mode</span>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h1>Navigation en AJAX</h1>

        <div id="content">
            <?php
                // On récupère le nom du dossier si le site est dans un dossier toto.com/dossier par exemple
                $dirname = pathinfo($_SERVER['SCRIPT_NAME'])['dirname'];
                // On récupère l'uri réelle (c'est à dire /pizzas au lieu de /dossier/pizzas)
                $uri = str_replace($dirname, '', $_SERVER['REQUEST_URI']);

                if ('/pizzas' === $uri) {
                    echo 'Page pizzas';
                } else if ('/burgers' === $uri) {
                    echo 'Page burgers';
                }
            ?>
        </div>

        <iframe width="560" height="315" src="https://www.youtube.com/embed/G2bx9iBfm2s" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>

    <!-- Attention, pas d'ajax dans la version slim de jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        $('a').click(function (event) {
            event.preventDefault();

            // On ajoute l'URL dans l'historique du navigateur afin de
            // simuler la navigation.
            history.pushState({page: $(this).attr('href')}, $(this).html(), $(this).attr('href'));

            $.ajax({
                type: 'GET',
                url: './worker.php?page=' + $(this).attr('href')
            }).done(function (data) {
                $('#content').html(data);
            });
        });

        // A chaque fois que l'utilisateur se sert de l'historique du navigateur
        $(window).on('popstate', function (event) {
            // On vérifie que l'event contient un état sinon c'est qu'on revient sur la page
            // d'accueil
            var page = (event.originalEvent.state) ? event.originalEvent.state.page : './';

            // On appelle la page de l'historique en AJAX
            $.ajax({
                type: 'GET',
                url: './worker.php?page=' + page
            }).done(function (data) {
                $('#content').html(data);
            });
        });

        // 1/ Au clic sur l'élément #switch-mode, on doit ajouter la classe .dark-mode sur body si elle n'est pas déjà présente et on doit retirer la classe si elle est déjà présente.
        // 2/ On doit également intervertir les classes navbar-light et bg-light de la navbar avec navbar-dark et bg-dark. Cela doit fonctionner dans les 2 sens.
        $('#switch-mode').on('click', function () {
            $('body').toggleClass('dark-mode');

            $('.navbar').toggleClass('navbar-light').toggleClass('navbar-dark');
            $('.navbar').toggleClass('bg-light').toggleClass('bg-dark');

            if ($('body').hasClass('dark-mode')) {
                localStorage.setItem('theme', 'dark');
            } else {
                localStorage.setItem('theme', 'light');
            }

            /* if ($('body').hasClass('dark-mode')) {
                $('.navbar').removeClass('navbar-light').addClass('navbar-dark');
                $('.navbar').removeClass('bg-light').addClass('bg-dark');
            } else {
                $('.navbar').addClass('navbar-light').removeClass('navbar-dark');
                $('.navbar').addClass('bg-light').removeClass('bg-dark');
            } */
        });

        $(document).ready(function () {
            // On va vérifier si l'utilisateur a déjà changé le thème du site
            var theme = localStorage.getItem('theme');

            if (theme === null) { // Si la personne vient sur le site pour la 1ère fois (pas obligatoire)
                theme = 'light'; // thème par défaut
            }

            if (theme === 'dark') { // Si la personne a choisit le thème dark
                $('body').toggleClass('dark-mode');

                $('.navbar').toggleClass('navbar-light').toggleClass('navbar-dark');
                $('.navbar').toggleClass('bg-light').toggleClass('bg-dark');
            }
        });
    </script>
</body>
</html>
