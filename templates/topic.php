<?php $this->layout('layouts/main', [
    'page_title' => $page_title,
    'page_description' => $page_description
]) ?>

<?php $this->start('page_content') ?>

<div class="container my-5">
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
                        if (get_session('user')->id === $topic->user_id || get_session('user')->role !== 'Utilisateur') :
                    ?>

                            <a href="<?= absolute_url('/sujet/modifier/' . $topic->id) ?>" class="btn btn-secondary mr-2">
                                <i class="fa fa-edit"></i> Modifier
                            </a>

                        <?php endif ?>

                        <a href="#" class="btn btn-primary" id="add-comment" data-topic-id="<?= $topic->id ?>" data-user-id="<?= get_session('user')->id ?>"><i class="fa fa-reply"></i> Répondre</a>

                    <?php endif ?>

                </div>
            </div>

            <h5 class="mt-3"><i class="fa fa-paperclip"></i> Fichiers joints</h5>

            <div class="card">
                <div class="card-body">
                    <div class="row no-gutters">

                        <?php
                        if (!empty($topic->attachments)) :
                            $attachments = explode(',', $topic->attachments);
                            $files_extensions = array('jpg', 'jpeg', 'png', 'gif');

                            foreach ($attachments as $attachment) :
                                $file_extension = explode('.', $attachment)[1];
                        ?>

                                <div class="col p-2">

                                    <?php if (in_array($file_extension, $files_extensions)) : ?>

                                        <a href="<?= absolute_url($attachment) ?>">
                                            <img src="<?= absolute_url('/public/' . $attachment) ?>" alt="Fichier joint" class="img-fluid">
                                        </a>

                                    <?php else : ?>

                                        <a href="<?= absolute_url('/public/' . $attachment) ?>"><?= $attachment ?></a>

                                    <?php endif ?>

                                </div>

                            <?php
                            endforeach;
                        else :
                            ?>

                            <span class="px-1">Aucun fichier joint</span>

                        <?php endif ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr class="my-4">

    <?php foreach ($comments as $comment) : ?>

        <div class="row mb-4">
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
                            if (get_session('user')->id === $comment->user_id || get_session('user')->role === "Modérateur") :
                        ?>

                                <a href="#" class="btn btn-secondary mr-2 edit-comment" data-comment-id="<?= $comment->id ?>" data-comment-content="<?= $comment->content ?>"><i class="fa fa-edit"></i> Modifier</a>

                                <?php
                            endif;

                            if (get_session('user')->id !== $comment->user_id) :

                                //$votes = load_model('votes');
                                if (false) :
                                ?>

                                    <a href="#" class="btn btn-success update-comment-score" data-user-id="<?= $comment->user_id ?>" data-comment-id="<?= $comment->id ?>">Voter</a>

                                <?php
                                endif;
                            else :
                                ?>

                                <a href="#" class="btn btn-success update-comment-score" data-user-id="<?= $comment->user_id ?>" data-comment-id="<?= $comment->id ?>">Annuler le vote</a>

                        <?php
                            endif;
                        endif
                        ?>

                    </div>
                </div>

                <h5 class="mt-3"><i class="fa fa-paperclip"></i> Fichiers joints</h5>

                <div class="card">
                    <div class="card-body">
                        <div class="row row-cols-3">

                            <?php
                            if (!empty($comment->attachments)) :
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

                                <?php
                                endforeach;
                            else :
                                ?>

                                <span class="px-3">Aucun fichier joint</span>

                            <?php endif ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-4">

    <?php endforeach ?>
</div>

<div class="modal fade" id="comment-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Répondre au sujet</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="comment-form" data-topic-id="" data-user-id="" data-comment-id="" action="<?= absolute_url('/comment/add/' . $topic->slug) ?>" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="comment"></label>
                        <textarea id="comment" rows="5" placeholder="Entrez votre message" class="form-control" required></textarea>
                    </div>

                    <div class="form-group" id="add-attachments">
                        <label for="attachments">Joindre des fichiers et images</label>
                        <input type="file" id="attachments" author="attachments[]" class="form-control-file" multiple>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="submit" class="btn btn-success" value="Répondre">
                    <button class="btn btn-danger" data-dismiss="modal">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $this->stop() ?>