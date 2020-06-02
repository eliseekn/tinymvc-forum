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
        <div class="d-flex justify-content-between">
            <h3>Gestion des Sujets de discussion</h3>

            <a href="<?= absolute_url('/sujet/nouveau') ?>" class="btn btn-success">
                <i class="fa fa-plus"></i> Nouveau sujet
            </a>
        </div>

        <hr>

        <div class="form-group">
            <label for="topics-filter">Filtrer les sujets de discussion par titre, catégorie, auteur ou date de création</label> <br>
            <input type="text" class="form-control" id="topics-filter" placeholder="Entrez les termes du filtre">
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col"></th>
                        <th scope="col" class="lead">Sujets de discussion</th>
                        <th scope="col" class="lead">Statistiques</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($topics as $topic) : ?>

                        <tr class="topic">
                            <th scope="row">
                                <div class="d-flex justify-content-center">
                                    <i class="far fa-file-alt fa-3x text-secondary"></i>
                                </div>
                            </th>

                            <td class="w-50">
                                <a href="<?= absolute_url('/sujet/' . $topic->slug) ?>" class="lead topic-title">
                                    <?= $topic->title ?>
                                </a> <br>

                                <span class="topic-category"><i class="fas fa-tag text-secondary"></i> <?= $topic->cat_name ?></span> <br>
                                <span class="topic-author"><i class="far fa-user text-secondary"></i> <?= $topic->author ?></span>
                                <span class="topic-date"><i class="far fa-clock text-secondary"></i> <?= date_format(new DateTime($topic->created_at), 'd/m/Y') ?></span>

                                <?php if ($topic->updated_at !== $topic->created_at) : ?>

                                    <span class="topic-date">
                                        <i class="far fa-clock text-secondary"></i>
                                        Dernière modification le <?= date('d/m/Y', $topic->updated_at) ?>
                                    </span>

                                <?php endif ?>
                            </td>

                            <td>
                                <i class="fa fa-comments <?php $topic->comments_count === 0 ? print('text-primary') : print('text-danger') ?>"></i>
                                <span class="font-weight-bold"><?= $topic->comments_count ?></span> Réponse(s)
                            </td>

                            <td>
                                
                                <?php if ($topic->state === 'open') : ?>

                                <a class="btn btn-warning" href="<?= absolute_url('/topic/close/' . $topic->id) ?>">Fermer</a>

                                <?php else : ?>

                                <a class="btn btn-success" href="<?= absolute_url('/topic/open/' . $topic->id) ?>">Ouvrir</a>

                                <?php endif ?>

                            </td>

                            <td>
                                <a class="btn btn-primary" href="<?= absolute_url('/sujet/modifier/' . $topic->id) ?>">
                                    Modifier
                                </a>
                            </td>

                            <td>
                                <a class="btn btn-danger delete-topic" href="#" data-topic-id="<?= $topic->id ?>">
                                    Supprimer
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

            <?php if ($topics->currentPage() > 1) : ?>

                <li class="page-item">
                    <a class="page-link" href="<?= $topics->previousPageUrl() ?>">
                        Page précédente
                    </a>
                </li>

            <?php endif ?>

            <?php
            if ($topics->totalPages() > 1) :
                for ($i = 1; $i <= $topics->totalPages(); $i++) :
            ?>

                    <li class="page-item <?php if ($topics->currentPage() === $i) : echo 'active'; endif ?>">
                        <a class="page-link" href="<?= $topics->pageUrl($i) ?>"><?= $i ?></a>
                    </li>

            <?php
                endfor;
            endif
            ?>

            <?php if ($topics->currentPage() < $topics->totalPages()) : ?>

                <li class="page-item">
                    <a class="page-link" href="<?= $topics->nextPageUrl() ?>">
                        Page suivante
                    </a>
                </li>

            <?php endif ?>
        </ul>
    </nav>
</div>

<?php $this->stop() ?>