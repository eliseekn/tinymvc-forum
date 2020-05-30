<?php $this->layout('layouts/main', [
    'page_title' => $page_title,
    'page_description' => $page_description
]) ?>

<?php $this->start('page_content') ?>

<div class="container my-5">

    <h3>Résultats de la recherche pour "<?= $search_query ?>"</h3>

    <hr>

    <?php if (empty($topics)) : ?>

    <p class="lead">Aucun résulat trouvé</p>

    <?php else : ?>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col"></th>
                    <th scope="col" class="lead">Sujets de discussion</th>
                    <th scope="col" class="lead">Statistiques</th>
                    <th scope="col" class="lead">Meilleure réponse</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($topics as $key => $topic) : ?>

                    <tr>
                        <th scope="row">
                            <div class="d-flex justify-content-center">
                                <i class="far fa-file-alt fa-3x text-secondary"></i>
                            </div>
                        </th>

                        <td class="w-50">
                            <a href="<?= absolute_url('/sujet/' . $topic->slug) ?>" class="lead"><?= $topic->title ?></a>

                            <br>

                            <i class="far fa-user text-secondary"></i> <?= $topic->author ?>
                            <i class="far fa-clock text-secondary"></i> <?= date_format(new DateTime($topic->created_at), 'd/m/Y') ?>

                            <br>

                            <span class="badge badge-warning"><?= $topic->author_department ?></span>

                            <span class="badge 
                                <?php
                                switch ($topic->author_grade) :
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
                                ?>
                            "><?= $topic->author_grade ?></span>
                        </td>

                        <td>
                            <i class="fa fa-comments <?php $topic->comments_count === 0 ? print('text-primary') : print('text-danger') ?>"></i>
                            <span class="font-weight-bold"><?= $topic->comments_count ?></span> Réponse(s)
                        </td>

                        <td>

                            <?php
                            if (isset($highest_votes[$key]) && isset($highest_votes[$key]->votes)) :
                                if ($highest_votes[$key]->votes === 0) : echo 'Aucune'; else :
                            ?>

                                    <div class="d-flex align-items-center">
                                        <span class="btn btn-lg rounded-circle text-white mr-2" style="<?= 'background-color: ' . random_color() ?>">

                                            <?php
                                            $author = $highest_votes[$key]->author;
                                            echo strtoupper($author[0]);
                                            ?>
                                        </span>

                                        <div>
                                            <span><?= $highest_votes[$key]->author ?></span> <br>
                                            <i class="fa fa-thumbs-up text-success"></i>
                                            <span class="font-weight-bold"><?= $highest_votes[$key]->votes ?></span> Vote(s)
                                        </div>
                                    </div>

                            <?php
                                endif;
                            else :
                                echo 'Aucune';
                            endif
                            ?>

                        </td>
                    </tr>

                <?php endforeach ?>

            </tbody>
        </table>
    </div>
    
    <nav class="mt-5">
        <ul class="pagination justify-content-center">

            <?php if ($topics->currentPage() > 1) : ?>

                <li class="page-item">
                    <a class="page-link" href="<?= $topics->previousPageUrl() . '&q=' . $search_query ?>">
                        Page précédente
                    </a>
                </li>

            <?php endif ?>

            <?php
            if ($topics->totalPages() > 1) :
                for ($i = 1; $i <= $topics->totalPages(); $i++) :
            ?>

                    <li class="page-item <?php if ($topics->currentPage() === $i) : echo 'active'; endif ?>">
                        <a class="page-link" href="<?= $topics->pageUrl($i) . '&q=' . $search_query ?>"><?= $i ?></a>
                    </li>

            <?php
                endfor;
            endif
            ?>

            <?php if ($topics->currentPage() < $topics->totalPages()) : ?>

                <li class="page-item">
                    <a class="page-link" href="<?= $topics->nextPageUrl() . '&q=' . $search_query ?>">
                        Page suivante
                    </a>
                </li>

            <?php endif ?>
        </ul>
    </nav> 
    
    <?php endif ?>

</div>

<?php $this->stop() ?>