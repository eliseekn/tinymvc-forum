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
        <h3>Gestion des Messages</h3>

        <hr>

        <div class="form-group">
            <label for="comments-filter">Filtrer les messages par titre du sujet, auteur et date de création</label>
            <input type="text" class="form-control" id="comments-filter" placeholder="Entrez les termes du filtre">
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col"></th>
                        <th scope="col" class="lead">Messages</th>
                        <th scope="col" class="lead">Statistiques</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($comments as $comment) : ?>

                        <tr class="comment">
                            <th scope="row">
                                <div class="d-flex justify-content-center">
                                    <i class="far fa-comment fa-3x text-secondary"></i>
                                </div>
                            </th>

                            <td style="width: 65%">
                                <p class="comment-content"><?= $comment->content ?></p>

                                <a href="<?= absolute_url('/sujet/' . $comment->topic_slug) ?>" class="comment-topic">
                                    <i class="far fa-file-alt text-secondary"></i> <?= $comment->topic_title ?>
                                </a>

                                <div>
                                    <span class="comment-author"><i class="far fa-user text-secondary"></i> <?= $comment->author ?></span>
                                    <span class="comment-date"><i class="far fa-clock text-secondary"></i> <?= date_format(new DateTime($comment->created_at), 'd/m/Y') ?></span>

                                    <?php if ($comment->updated_at !== $comment->created_at) : ?>

                                        <span class="comment-date">
                                            <i class="far fa-clock text-secondary"></i>
                                            Dernière modification le <?= date_format(new DateTime($comment->updated_at), 'd/m/Y') ?>
                                            à <?= date_format(new DateTime($comment->updated_at), 'H:i') ?>
                                        </span>

                                    <?php endif ?>

                                </div>
                            </td>

                            <td>
                                <i class="fa fa-thumbs-up <?php $comment->votes === 0 ? print('text-primary') : print('text-danger') ?>"></i>
                                <span class="font-weight-bold"><?= $comment->votes ?></span> Vote(s)
                            </td>

                            <td>
                                <a class="btn btn-danger delete-comment" href="#" data-comment-id="<?= $comment->id ?>">
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

            <?php if ($comments->currentPage() > 1) : ?>

                <li class="page-item">
                    <a class="page-link" href="<?= $comments->previousPageUrl() ?>">
                        Page précédente
                    </a>
                </li>

            <?php endif ?>

            <?php
            if ($comments->totalPages() > 1) :
                for ($i = 1; $i <= $comments->totalPages(); $i++) :
            ?>

                    <li class="page-item <?php if ($comments->currentPage() === $i) : echo 'active';;endif ?>">
                        <a class="page-link" href="<?= $comments->pageUrl($i) ?>"><?= $i ?></a>
                    </li>

            <?php
                endfor;
            endif
            ?>

            <?php if ($comments->currentPage() < $comments->totalPages()) : ?>

                <li class="page-item">
                    <a class="page-link" href="<?= $comments->nextPageUrl() ?>">
                        Page suivante
                    </a>
                </li>

            <?php endif ?>
        </ul>
    </nav>
</div>

<?php $this->stop() ?>