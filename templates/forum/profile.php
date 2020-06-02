<?php $this->layout('forum/layout', [
    'page_title' => $page_title,
    'page_description' => $page_description
]) ?>

<?php $this->start('page_content') ?>

<div class="container my-5">

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

    <h3>Modifier votre profil d'utilisateur</h3>

    <hr>
    <form method="post" action="<?= absolute_url('/user/update/' . $user->id) ?>">
        <div class="form-group">
            <label for="name">Nom et prénoms</label>
            <input type="text" class="form-control" name="name" id="name" value="<?= $user->name ?>">
        </div>

        <div class="form-group">
            <label>Sexe</label> <br>

            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="male" name="gender" value="Masculin" class="custom-control-input" <?php if ($user->gender === 'Masculin') : echo 'checked'; endif ?>>
                <label class="custom-control-label" for="male">Masculin</label>
            </div>

            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="female" name="gender" value="Féminin" class="custom-control-input" <?php if ($user->gender === 'Féminin') : echo 'checked'; endif ?>>
                <label class="custom-control-label" for="female">Féminin</label>
            </div>
        </div>

        <div class="form-group">
            <label for="department">Filière d'étude</label>
            <input type="text" class="form-control" name="department" id="department" value="<?= $user->department ?>">
        </div>

        <div class="form-group">
            <label for="grade">Niveau d'étude</label>
            <select class="custom-select" id="grade" name="grade">
                <option value="8e année" <?php if ($user->grade === '8e année') : echo 'selected'; endif ?>>8e année</option>
                <option value="7e année" <?php if ($user->grade === '7e année') : echo 'selected'; endif ?>>7e année</option>
                <option value="6e année" <?php if ($user->grade === '6e année') : echo 'selected'; endif ?>>6e année</option>
                <option value="5e année" <?php if ($user->grade === '5e année') : echo 'selected'; endif ?>>5e année</option>
                <option value="4e année" <?php if ($user->grade === '4e année') : echo 'selected'; endif ?>>4e année</option>
                <option value="3e année" <?php if ($user->grade === '3e année') : echo 'selected'; endif ?>>3e année</option>
                <option value="2e année" <?php if ($user->grade === '2e année') : echo 'selected'; endif ?>>2e année</option>
                <option value="1ère année" <?php if ($user->grade === '1ère année') : echo 'selected'; endif ?>>1ère année</option>
            </select>
        </div>

        <div class="form-group">
            <label for="username">Adresse email</label>
            <input type="email" class="form-control" name="email" id="email" value="<?= $user->email ?>">
        </div>

        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" class="form-control" name="password" id="password">
            
            <div class="custom-control custom-checkbox mt-3">
                <input type="checkbox" class="custom-control-input" id="password-toggle1">
                <label class="custom-control-label" for="password-toggle1" onclick="togglePassword('#password')">Afficher le mot de passe</label>
            </div>
        </div>

        <div class="form-group">
            <label for="password">Nouveau mot de passe</label>
            <input type="password" class="form-control" name="new-password" id="new-password">

            <div class="custom-control custom-checkbox mt-3">
                <input type="checkbox" class="custom-control-input" id="password-toggle2">
                <label class="custom-control-label" for="password-toggle2" onclick="togglePassword('#new-password')">Afficher le mot de passe</label>
            </div>
        </div>

        <input type="submit" class="btn btn-primary mt-4" value="Sauvegarder">
    </form>
</div>

<?php $this->stop() ?>