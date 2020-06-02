<?php $this->layout('admin/layout', [
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
            <div class="alert alert-success alert-dismissible show mb-5" role="alert">

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

            <div class="alert alert-danger alert-dismissible show mb-5" role="alert">

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

    <div class="container my-5">
        <h3>Gestion des Utilisateurs</h3>

        <hr>

        <div class="form-group">
            <label for="users-filter">Filtrer les utilisateurs par nom, email, date d'inscription, filière ou niveau d'étude</label>
            <input type="text" class="form-control" id="users-filter" placeholder="Entrez les termes du filtre">
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col"></th>
                        <th scope="col" class="lead">Identification</th>
                        <th scope="col" class="lead">Statistiques</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($users as $key => $user) : ?>

                        <tr class="user">
                            <th scope="row">
                                <div class="d-flex justify-content-center align-items-center">
                                    <span class="btn btn-lg rounded-circle text-white mr-2" style="<?= 'background-color: ' . random_color() ?>">
                                        
                                        <?php
                                        $author = $user->name;
                                        echo strtoupper($author[0]);
                                        ?>

                                    </span>
                                </div>
                            </th>

                            <td>
                                <span class="lead user-name"><?= $user->name ?></span> <br>
                                <span class="user-email"><i class="far fa-envelope text-secondary"></i> <?= $user->email ?></span> <br>
                                <span class="user-date"><i class="far fa-clock text-secondary"></i> <?= date_format(new DateTime($user->created_at), 'd/m/Y') ?></span> <br>
                                <span class="badge badge-warning user-department"><?= $user->department ?></span>
                                
                                <span class="badge user-grade
                                    <?php
                                    switch ($user->grade):
                                        case '1ère année':
                                        case '2e année':
                                            echo 'badge-secondary';
                                            break;
                                        case '3e année':
                                            echo 'badge-primary';
                                            break;
                                        default:
                                            echo 'badge-danger';
                                            break;
                                    endswitch
                                    ?> text-wrap text-left"><?= $user->grade ?>
                                </span>
                            </td>

                            <td>
                                <i class="fa fa-file-alt text-secondary"></i> <?= $total_topics[$key] ?> Sujet(s) de discussion <br>
                                <i class="fa fa-comments text-primary"></i> <?= $total_comments[$key] ?> Réponse(s) <br>
                                <i class="fa fa-thumbs-up text-success"></i> <?= $total_votes[$key] ?> Vote(s)
                            </td>

                            <td>
                                <a class="btn btn-danger delete-user" href="#" data-user-id="<?= $user->id ?>">
                                    <i class="fa fa-trash"></i> Supprimer
                                </a>
                            </td>
                        </tr>

                    <?php endforeach ?>

                </tbody>
            </table>
        </div>
    </div>

    <nav class="mt-5">
        <ul class="pagination justify-content-center">

            <?php if ($users->currentPage() > 1) : ?>

                <li class="page-item">
                    <a class="page-link" href="<?= $users->previousPageUrl() ?>">
                        Page précédente
                    </a>
                </li>

            <?php endif ?>

            <?php
            if ($users->totalPages() > 1) :
                for ($i = 1; $i <= $users->totalPages(); $i++) :
            ?>

                    <li class="page-item <?php if ($users->currentPage() === $i) : echo 'active'; endif ?>">
                        <a class="page-link" href="<?= $users->pageUrl($i) ?>"><?= $i ?></a>
                    </li>

            <?php
                endfor;
            endif
            ?>

            <?php if ($users->currentPage() < $users->totalPages()) : ?>

                <li class="page-item">
                    <a class="page-link" href="<?= $users->nextPageUrl() ?>">
                        Page suivante
                    </a>
                </li>

            <?php endif ?>
        </ul>
    </nav>
</div>

<?php $this->stop() ?>