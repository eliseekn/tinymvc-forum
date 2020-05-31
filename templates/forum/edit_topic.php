<?php $this->layout('forum/layout', [
    'page_title' => $page_title,
    'page_description' => $page_description
]) ?>

<?php $this->start('page_content') ?>

<div class="container my-5">
    <h3>Modifier un sujet de discussion</h3>

    <hr>

    <?php
    if (session_has('flash_messages')) :
        $flash_messages = get_flash_messages('flash_messages');

        if (isset($flash_messages['edit_success'])) :
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

    <form method="post" action="<?= absolute_url('/topic/update/' . $topic->id) ?>" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Titre du sujet</label>
            <input type="text" class="form-control" name="title" id="title" value="<?= $topic->title ?>">
        </div>

        <div class="form-group">
            <label for="content">Contenu</label>
            <textarea name="content" id="content" rows="5" class="form-control"><?= $topic->content ?></textarea>
        </div>

        <!-- <div class="form-group">
            <label for="attachments">Joindre des fichiers et images</label>
            <input type="file" id="attachments" name="attachments[]" class="form-control-file" multiple>
        </div> -->

        <input type="submit" class="btn btn-primary mt-4" value="Modifier le sujet">
    </form>
</div>

<?php $this->stop() ?>