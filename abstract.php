<?php include_once "./include/link.php"; ?>
<?php
$article_id = $_GET['article_id'] ?? 0;
$article = $functions->getabstract($article_id);

?>
<?php include_once "./include/header.php"; ?>

<!-- ///ABSTRACT////// -->
<div class="card border-0 shadow-sm">

    <div class="card-body p-3">

     <h2 class="border-bottom pb-2 mb-4">Abstract</h2>

        <h3 class="fw-bold mb-3">
            <?= $article['title'] ?>
        </h3>

        <p class="text-secondary mb-1">
            <strong>Author Details:</strong>
            <?= $article['authors'] ?>
        </p>

        <p class="text-muted fst-italic mb-1">
            Published:
            <?= date("d M Y", strtotime($article['publish_date'])) ?>
            &nbsp; | &nbsp;
            Pages <?= $article['pages'] ?>
        </p>

        <hr>

        <div class="d-flex flex-wrap gap-4 small text-muted mb-3">

            <span>
                <strong>Category:</strong>
                <?= $article['article_type'] ?>
            </span>

            <?php if (!empty($article['doi'])): ?>
                <span>
                    <i class="bi bi-link-45deg me-1"></i>
                    DOI:
                    <a href="<?= $article['doi'] ?>"
                        target="_blank"
                        class="text-decoration-none text-success">

                        <?= $article['doi'] ?>

                    </a>
                </span>
            <?php endif; ?>

            <span>
                <i class="bi bi-eye"></i>
                <?= (int)$article['view'] ?> Views
            </span>

            <span>
                <i class="bi bi-download"></i>
                <?= (int)$article['download'] ?> Downloads
            </span>

        </div>

        <?= $functions->articleButtons(
            $article['article_id'],
            $article['file_url'],
            $base_url,
            'abstract'
        ); ?>

        <hr>

        <h5 class="fw-bold mb-3">
            Abstract
        </h5>

        <div class="mb-4">
            <?= $article['long_desc'] ?>
        </div>

        <hr>

        <div class="mb-3">
            <strong>References:</strong><br>
            <?= $article['referances'] ?>
        </div>

        <div class="mb-3">
            <strong>Keywords:</strong><br>
            <?= $article['keywords'] ?>
        </div>

    </div>

</div>
<!-- ///////////////////// -->

<?php include_once "./include/footer.php"; ?>