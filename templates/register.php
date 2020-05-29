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
            <h2 class="py-3 text-center text-white">Inscription au forum</h2>

            <div class="card shadow p-4 mb-4">
                <form id="register-form">
                    <div class="form-group">
                        <label for="name">Nom et prénoms</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Entrez votre nom et prénoms">
                    </div>

                    <div class="form-group">
                        <label>Sexe</label> <br>

                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="male" name="gender" value="Masculin" class="custom-control-input" checked>
                            <label class="custom-control-label" for="male">Masculin</label>
                        </div>

                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="female" name="gender" value="Féminin" class="custom-control-input">
                            <label class="custom-control-label" for="female">Féminin</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="department">Filière d'étude</label>
                        <input type="text" class="form-control" name="department" id="department" placeholder="Entrez votre filière">
                    </div>

                    <div class="form-group">
                        <label for="grade">Niveau d'étude</label>
                        <select class="custom-select" id="grade">
                            <option value="8e année">8e année</option>
                            <option value="7e année">7e année</option>
                            <option value="6e année">6e année</option>
                            <option value="5e année">5e année</option>
                            <option value="4e année">4e année</option>
                            <option value="3e année">3e année</option>
                            <option value="2e année">2e année</option>
                            <option value="1ère année" selected>1ère année</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="username">Adresse email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Entrez votre adresse email">
                    </div>

                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Entrez votre mot de passe">
                    </div>

                    <input type="submit" class="btn btn-lg btn-dark" value="Envoyer">
                </form>
            </div>

            <h5 class="pb-4 text-center text-white">
                Déjà inscris? Connectez-vous <a href="<?= absolute_url('/connexion') ?>">ici</a>
            </h5>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>