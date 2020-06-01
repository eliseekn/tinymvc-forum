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

    <div class="row">
        <div class="col">
            <div class="d-flex align-items-center">
                <span class="btn btn-lg rounded-circle text-white mr-2" style="<?= 'background-color: ' . random_color() ?>">

                    <?php
                    $author = $topic->author;
                    echo strtoupper($author[0]);
                    ?>

                </span>
            </div>
        </div>

        <div class="col-lg-2">
            <span><?= $topic->author ?></span> <br>
            <span class="badge badge-danger text-wrap text-left">
                Auteur
            </span> <br>
            <span class="my-2"><i class="far fa-clock text-secondary"></i> <?= date_format(new DateTime($topic->created_at), 'd/m/Y') ?></span> <br>
            <span class="badge badge-warning text-wrap text-left my-2">
                <?= $topic->author_department ?>
            </span> <br>
            <span class="badge 
                    <?php
                    switch ($topic->author_grade):
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
                    ?> text-wrap text-left"><?= $topic->author_grade ?>
            </span>
        </div>

        <div class="col-lg-9">
            <h3 class="card-title">
                <i class="far fa-file-alt"></i> <?= $topic->title ?>
            </h3>

            <div class="card">
                <div class="card-body">
                    <?= $topic->content ?>
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-between mt-3">
                <div>
                    <i class="fa fa-comments text-primary mr-2"></i>
                    <span class="font-weight-bold"><?= $topic->comments_count ?></span> Réponse(s)

                    <?php if ($topic->created_at !== $topic->updated_at) : ?>
                        <i class="far fa-clock text-secondary"></i> Dernière modification le <?= date_format(new DateTime($topic->created_at), 'd/m/Y') ?>
                    <?php endif ?>
                </div>

                <div>
                    <?php
                    if (session_has('user')) :
                        if (get_session('user')->id === $topic->user_id || get_session('user')->role === 'Modérateur') :
                    ?>

                            <a href="<?= absolute_url('/sujet/modifier/' . $topic->id) ?>" class="btn btn-secondary mr-2">
                                <i class="fa fa-edit"></i> Modifier
                            </a>

                        <?php 
                            endif;
                        
                        if ($topic->state === 'open') :
                        ?>

                        <a href="#" id="add-comment" class="btn btn-primary">Répondre</a>

                    <?php 
                        endif;
                    endif 
                    ?>

                </div>
            </div>

            <?php if (!empty($topic->attachments)) : ?>

            <h5 class="mt-3"><i class="fa fa-paperclip"></i> Fichiers joints</h5>

            <div class="card">
                <div class="card-body">
                    <div class="row no-gutters">

                        <?php
                            $attachments = explode(',', $topic->attachments);
                            $files_extensions = array('jpg', 'jpeg', 'png', 'gif');

                            foreach ($attachments as $attachment) :
                                $file_extension = explode('.', $attachment)[1];
                        ?>

                                <div class="col p-2">

                                    <?php if (in_array($file_extension, $files_extensions)) : ?>

                                        <a href="<?= absolute_url('/public/' . $attachment) ?>">
                                            <img src="<?= absolute_url('/public/' . $attachment) ?>" alt="Fichier joint" class="img-fluid">
                                        </a>

                                    <?php else : ?>

                                        <a href="<?= absolute_url('/public/' . $attachment) ?>"><?= $attachment ?></a>

                                    <?php endif ?>

                                </div>

                        <?php endforeach; ?>

                    </div>
                </div>
            </div>

            <?php endif ?>

            <div class="d-none" id="add-comment-form">
                <h5 class="mt-3"><i class="fa fa-reply"></i> Répondre au sujet</h5>

                <form method="post" action="<?= absolute_url('/comment/add/' . $topic->id) ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <textarea id="content" name="content" rows="5" placeholder="Entrez votre message de réponse" class="form-control"></textarea>
                    </div>

                    <div class="d-flex align-items-center justify-content-between">
                        <div class="form-group">
                            <label for="attachments">Joindre des fichiers et images</label>
                            <input type="file" id="attachments" name="attachments[]" class="form-control-file" multiple>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Envoyer">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <h3 class="mt-5"><i class="fa fa-comments"></i> Réponses au sujet</h3>
    <hr class="mb-4">

    <?php foreach ($comments as $key => $comment) : ?>

        <div class="row mb-5">
            <div class="col">
                <div class="d-flex align-items-center">
                    <button class="btn btn-lg rounded-circle text-white mr-2" style="<?= 'background-color: ' . random_color() ?>">

                        <?php
                        $author = $comment->author;
                        echo strtoupper($author[0]);
                        ?>

                    </button>
                </div>
            </div>

            <div class="col-lg-2">
                <span><?= $comment->author ?></span> <br>

                <?php if ($topic->user_id === $comment->user_id) : ?>

                    <span class="badge badge-danger text-wrap text-left">
                        Auteur
                    </span> <br>

                <?php endif ?>

                <?php if ($comment->author_role !== 'Utilisateur') : ?>

                    <span class="badge badge-warning text-wrap text-left"><?= $comment->author_role ?></span> <br>

                <?php endif ?>

                <span class="my-2"><i class="far fa-clock text-secondary"></i> <?= date_format(new DateTime($topic->created_at), 'd/m/Y') ?></span> <br>
                <span class="badge badge-warning text-wrap text-left my-2">
                    <?= $comment->author_department ?>
                </span> <br>
                <span class="badge 
                    <?php
                    switch ($comment->author_grade):
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
                    ?> text-wrap text-left"><?= $comment->author_grade ?>
                </span>
            </div>

            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body">
                        <?= $comment->content ?>
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-between mt-3">
                    <div>
                        <i class="fa fa-thumbs-up text-success mr-2"></i>
                        <span class="font-weight-bold"><?= $comment->votes ?></span> Vote(s)

                        <?php if ($comment->created_at !== $comment->updated_at) : ?>
                            <i class="far fa-clock text-secondary"></i> Dernière modification le <?= date_format(new DateTime($topic->created_at), 'd/m/Y') ?>
                        <?php endif ?>
                    </div>

                    <div>

                        <?php
                        if (session_has('user')) :
                            if (get_session('user')->id === $comment->user_id || get_session('user')->role === 'Modérateur') :
                        ?>

                                <a href="#" class="btn btn-secondary mr-2 edit-comment" data-comment-id="<?= $comment->id ?>" data-comment-content="<?= $comment->content ?>"><i class="fa fa-edit"></i> Modifier</a>

                                <?php
                            endif;

                            if (get_session('user')->id !== $comment->user_id) :
                                if (
                                    !empty($voters[$key]) &&
                                    get_session('user')->id !== $voters[$key]['user_id'] &&
                                    $comment->id !== $voters[$key]['comment_id']
                                ) :
                                ?>

                                    <a href="<?= absolute_url('/comment/dismiss_vote/' . $comment->id) ?>" class="btn btn-success">Annuler le vote</a>

                                <?php
                                else :
                                ?>

                                    <a href="<?= absolute_url('/comment/vote/' . $comment->id) ?>" class="btn btn-success">Voter</a>

                        <?php
                                endif;
                            endif;
                        endif
                        ?>

                    </div>
                </div>

                <?php if (!empty($comment->attachments)) : ?>

                <h5 class="mt-3"><i class="fa fa-paperclip"></i> Fichiers joints</h5>

                <div class="card">
                    <div class="card-body">
                        <div class="row row-cols-3">

                            <?php
                                $attachments = explode(',', $comment->attachments);
                                $files_extensions = array('jpg', 'jpeg', 'png', 'gif');

                                foreach ($attachments as $attachment) :
                                    $file_extension = explode('.', $attachment)[1];
                            ?>

                                    <div class="col">

                                        <?php if (in_array($file_extension, $files_extensions)) : ?>
                                            <a href="<?= absolute_url('/public/' . $attachment) ?>">
                                                <img src="<?= absolute_url('/public/' . $attachment) ?>" alt="Fichier joint" class="img-fluid">
                                            </a>

                                        <?php else : ?>

                                            <a href="<?= absolute_url('/public/' . $attachment) ?>"><?= $attachment ?></a>

                                        <?php endif ?>

                                    </div>

                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>

                <?php endif ?>

            </div>
        </div>

    <?php endforeach ?>

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

                    <li class="page-item <?php if ($comments->currentPage() === $i) : echo 'active'; endif ?>">
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

<div class="modal" id="comment-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifier votre message de réponse</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="edit-comment-form">
                <div class="modal-body">
                    <div class="form-group">
                        <textarea id="content" name="content" rows="5" class="form-control" required></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="submit" class="btn btn-success" value="Envoyer">
                    <button class="btn btn-danger" data-dismiss="modal">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $this->stop() ?>