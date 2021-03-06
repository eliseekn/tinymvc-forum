<?php $this->layout('forum/layout', [
    'page_title' => $page_title,
    'page_description' => $page_description
]) ?>

<?php $this->start('page_content') ?>

<div class="container my-5">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col"></th>
                    <th scope="col" class="lead">Forums</th>
                    <th scope="col" class="lead">Statistiques</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($categories as $category) : ?>

                    <tr>
                        <th scope="row">
                            <div class="d-flex justify-content-center">
                                <i class="fas fa-tag fa-3x text-secondary"></i>
                            </div>
                        </th>

                        <td class="w-50">
                            <a href="<?= absolute_url('/forum/' . $category->slug) ?>" class="lead">
                                <?= $category->name ?>
                            </a> <br>

                            <p><?= $category->description ?></p>
                        </td>

                        <td>
                            <i class="far fa-file-alt <?php $category->topics_count === 0 ? print('text-primary') : print('text-danger') ?>"></i>
                            <span class="font-weight-bold"><?= $category->topics_count ?></span> Sujet(s) de discussion
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

                    <li class="page-item <?php if ($categories->currentPage() === $i) : echo 'active';
                                            endif ?>">
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

<?php $this->stop() ?>