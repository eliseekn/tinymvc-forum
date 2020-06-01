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

    <div class="d-flex justify-content-between">
        <h3>Gestion des Forums</h3>

        <a href="#" id="add-category" class="btn btn-success">
            <i class="fa fa-plus"></i> Nouveau forum
        </a>
    </div>

    <div class="d-none mt-3" id="add-category-form">
        <form method="post" action="<?= absolute_url('/category/add') ?>">
            <div class="form-group">
                <label for="name">Nom du forum</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Entrez le nom du forum">
            </div>

            <div class="form-group">
                <label for="description">Description du forum</label>
                <textarea id="description" name="description" rows="5" placeholder="Entrez la description du forum" class="form-control"></textarea>
            </div>

            <div class="form-group align-left">
                <input type="submit" class="btn btn-primary" value="Créer le forum">
            </div>
        </form>
    </div>

    <hr>

    <div class="form-group">
        <label for="categories-filter">Filtrer les forums par nom ou description</label> <br>
        <input type="text" class="form-control" id="categories-filter" placeholder="Entrez les termes du filtre">
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col"></th>
                    <th scope="col" class="lead">Forums</th>
                    <th scope="col" class="lead">Statistiques</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($categories as $category) : ?>

                    <tr class="category">
                        <th scope="row">
                            <div class="d-flex justify-content-center">
                                <i class="fas fa-tag fa-3x text-secondary"></i>
                            </div>
                        </th>

                        <td class="w-50">
                            <a href="<?= absolute_url('/forum/' . $category->slug) ?>" class="lead category-name">
                                <?= $category->name ?>
                            </a> <br>

                            <p class="category-description"><?= $category->description ?></p>
                        </td>

                        <td>
                            <i class="far fa-file-alt <?php $category->topics_count === 0 ? print('text-primary') : print('text-danger') ?>"></i>
                            <span class="font-weight-bold"><?= $category->topics_count ?></span> Sujet(s) de discussion
                        </td>

                        <td>
                            <a href="<?= absolute_url('/category/close/' . $category->id) ?>" data-category-id="<?= $category->id ?>" class="btn btn-danger delete-category">
                                <i class="fa fa-trash"></i> Supprimer
                            </a>
                        </td>

                        <td>
                            <a href="<?= absolute_url('/category/update/' . $category->id) ?>" data-category-id="<?= $category->id ?>" data-category-name="<?= $category->name ?>" data-category-description="<?= $category->description ?>" class="btn btn-primary edit-category">
                            <i class="fa fa-edit"></i> Modifier
                            </a>
                        </td>
                    </tr>

                <?php endforeach ?>

            </tbody>
        </table>
    </div>

    <nav class="mt-5">
        <ul class="pagination justify-content-center">

            <?php if ($categories->currentPage() > 1) : ?>

                <li class="page-item">
                    <a class="page-link" href="<?= $categories->previousPageUrl() ?>">
                        Page précédente
                    </a>
                </li>

            <?php endif ?>

            <?php
            if ($categories->totalPages() > 1) :
                for ($i = 1; $i <= $categories->totalPages(); $i++) :
            ?>

                    <li class="page-item <?php if ($categories->currentPage() === $i) : echo 'active'; endif ?>">
                        <a class="page-link" href="<?= $categories->pageUrl($i) ?>"><?= $i ?></a>
                    </li>

            <?php
                endfor;
            endif
            ?>

            <?php if ($categories->currentPage() < $categories->totalPages()) : ?>

                <li class="page-item">
                    <a class="page-link" href="<?= $categories->nextPageUrl() ?>">
                        Page suivante
                    </a>
                </li>

            <?php endif ?>
        </ul>
    </nav>
</div>

<div class="modal" id="category-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifier un forum de discussion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="edit-category-form">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nom du forum</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description du forum</label>
                        <textarea id="description" name="description" rows="5" class="form-control" required></textarea>
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