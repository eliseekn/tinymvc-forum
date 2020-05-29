<?php $this->layout('layouts/main', [
    'page_title' => $page_title,
    'page_description' => $page_description
]) ?>

<?php $this->start('page_content') ?>

<div class="container my-5">
    <h3>Modifier un sujet de discussion</h3>

    <hr>

    <form method="post" action="<?= absolute_path('/topic/update/' . $topic->id) ?>" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Titre du sujet</label>
            <input type="text" class="form-control" name="title" id="title" value="<?= $topic->title ?>">
        </div>

        <div class="form-group">
            <label for="content">Contenu</label>
            <textarea id="content" rows="5" class="form-control"><?= $topic->content ?></textarea>
        </div>

        <!-- <div class="form-group">
            <label for="attachments">Joindre des fichiers et images</label>
            <input type="file" id="attachments" name="attachments[]" class="form-control-file" multiple>
        </div> -->

        <input type="submit" class="btn btn-primary mt-4" value="Modifier le sujet">
    </form>
</div>

<?php $this->stop() ?>