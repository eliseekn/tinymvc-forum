<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?= $page_description ?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= absolute_url('/public/assets/css/main.css') ?>">
    <title><?= $page_title ?></title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top py-4">
        <div class="container">
            <a class="navbar-brand" href="<?= absolute_url('/admin') ?>">
                Administration
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto mr-0 mr-lg-2">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?= absolute_url('/admin/forums') ?>">Forums</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="<?= absolute_url('/admin/utilisateurs') ?>">Utilisateurs</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="<?= absolute_url('/admin/sujets') ?>">Sujets de discussion</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="<?= absolute_url('/admin/messages') ?>">Messages</a>
                    </li>
                </ul>

                <a class="btn btn-danger mr-0 mr-lg-2 my-3 my-lg-0 d-block" href="<?= absolute_url('/deconnexion') ?>">Déconnexion</a>
                <a class="btn btn-primary mr-0 mr-lg-2 my-3 my-lg-0 d-block" href="<?= absolute_url('/') ?>">Retour à l'accueil</a>
            </div>
        </div>
    </nav>

    <?= $this->section('page_content') ?>

    <script defer src="https://use.fontawesome.com/releases/v5.13.0/js/all.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <script src="<?= absolute_url('/public/assets/js/const.js') ?>"></script>
    <script src="<?= absolute_url('/public/assets/js/components/request.js') ?>"></script>
    <script src="<?= absolute_url('/public/assets/js/ui/search.js') ?>"></script>
    <script src="<?= absolute_url('/public/assets/js/ui/users.js') ?>"></script>
    <script src="<?= absolute_url('/public/assets/js/ui/categories.js') ?>"></script>
    <script src="<?= absolute_url('/public/assets/js/ui/topics.js') ?>"></script>
    <script src="<?= absolute_url('/public/assets/js/ui/comments.js') ?>"></script>
</body>

</html>