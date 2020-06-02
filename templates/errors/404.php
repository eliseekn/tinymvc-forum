<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="La page que vous cherchez n'a pas été trouvée sur le serveur">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= absolute_url('/public/assets/css/main.css') ?>">
    <title>Page non trouvée | eduForum</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top py-4">
        <div class="container">
            <a class="navbar-brand" href="<?= absolute_url('/') ?>">eduForum</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse d-lg-flex justify-content-between align-items-center" id="navbarNav">
                <div class="input-group flex-grow-1 mt-lg-0 mt-3 mr-0 mr-lg-3">
                    <input type="search" class="form-control" id="search-query" placeholder="Rechercher un sujet de discussion">

                    <div class="input-group-append">
                        <div class="input-group-text">
                            <i id="search-btn" class="fa fa-search"></i>
                        </div>
                    </div>
                </div>

                <a class="btn <?php session_has('user') ? print('btn-danger') : print('btn-primary'); ?> mr-0 mr-lg-3 my-3 my-lg-0 d-block" href="<?php session_has('user') ? print(absolute_url('/deconnexion')) : print(absolute_url('/connexion')); ?>">
                    <?php session_has('user') ? print('Déconnexion') : print('Connexion'); ?>
                </a>

                <?php if (session_has('user')) : ?>

                    <a href="<?= absolute_url('/sujet/nouveau') ?>" class="btn btn-success mr-0 mr-lg-3 my-3 my-lg-0 d-block flex-shrink-0">
                        <i class="fa fa-plus"></i> Nouveau sujet
                    </a>

                    <a href="<?= absolute_url('/utilisateur/profil/' . get_session('user')->id) ?>" class="btn btn-primary mr-0 mr-lg-3 my-3 my-lg-0 d-block flex-shrink-0">
                        <i class="fa fa-edit"></i> Modifier le profil
                    </a>

                <?php if (get_session('user')->role === 'Administrateur') : ?>

                    <a class="btn btn-warning d-block flex-shrink-0" href="<?= absolute_url('/admin') ?>">
                        Administration
                    </a>

                <?php 
                    endif;
                endif 
                ?>

            </div>
        </div>
    </nav>

    <div class="container d-flex align-items-center justify-content-center mt-5">
        <div class="card shadow d-flex flex-column align-items-center p-5 mt-5 bg-dark">
            <i class="fa fa-dizzy fa-5x text-white"></i>
            <h1 class="display-4 pt-3 text-center text-white">Erreur 404</h1>
            <h5 class="py-3 text-center text-white">
                Désolé, la page que vous cherchez n'a pas été trouvée sur le serveur.
            </h5>

            <a href="<?= absolute_url('/') ?>" class="btn btn-primary">Retourner à l'accueil</a>
        </div>
    </div>

    <script defer src="https://use.fontawesome.com/releases/v5.13.0/js/all.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>