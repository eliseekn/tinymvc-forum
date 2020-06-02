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
    <div class="d-flex align-items-center justify-content-center min-vh-100 bg-dark">
        <div class="container" style="width: 500px">
            <h1 class="display-4 pt-3 text-center text-white">eduForum</h1>
            <h2 class="py-3 text-center text-white">Connexion au forum</h2>

            <?php
            if (session_has('flash_messages')) :
                $flash_messages = get_flash_messages('flash_messages');

                if (isset($flash_messages['success'])) :
            ?>
                    <div class="alert alert-success alert-dismissible show" role="alert">

                        <?php
                        foreach ($flash_messages as $flash_message) :
                            echo $flash_message . '<br>';
                        endforeach;
                        ?>

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

            <?php else : ?>

                    <div class="alert alert-danger alert-dismissible show" role="alert">

                        <?php
                        foreach ($flash_messages as $flash_message) :
                            if (is_array($flash_message)) :
                                foreach ($flash_message as $error_message) :
                                    echo $error_message . '<br>';
                                endforeach;
                            else :
                                echo $flash_message . '<br>';
                            endif;
                        endforeach
                        ?>

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

            <?php
                endif;
            endif
            ?>

            <div class="card shadow p-4">
                <form method="post" action="<?= absolute_url('/user/login') ?>">
                    <?= generate_csrf_token() ?>

                    <div class="form-group">
                        <label for="email">Adresse email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Entrez votre adresse email">
                    </div>

                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Entrez votre mot de passe">

                        <div class="custom-control custom-checkbox mt-3">
                            <input type="checkbox" class="custom-control-input" id="password-toggle">
                            <label class="custom-control-label" for="password-toggle" onclick="togglePassword('#password')">Afficher le mot de passe</label>
                        </div>
                    </div>

                    <div class="form-group custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="remember-me" name="remember-me" checked>
                        <label class="custom-control-label" for="remember-me">Rester connecter</label>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <input type="submit" class="btn btn-lg btn-dark" value="Envoyer">
                        <a href="#">Mot de passe oublié?</a>
                    </div>
                </form>
            </div>

            <h5 class="py-4 text-center text-white">
                Pas de compte? Inscrivez-vous <a href="<?= absolute_url('/inscription') ?>">ici</a>
            </h5>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	<script src="<?= absolute_url('/public/assets/js/components/password.js') ?>"></script>
</body>

</html>